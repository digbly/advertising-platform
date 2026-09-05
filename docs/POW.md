# HƯỚNG DẪN TÍCH HỢP PROOF OF WORK (PoW) CAPTCHA CHO FRONTEND

Luồng PoW Captcha hoạt động theo cơ chế **Thử thách - Phản hồi (Challenge - Response)**. FE cần gửi yêu cầu lấy một thử thách (challenge) từ BE, giải thử thách đó trên trình duyệt bằng cách chạy vòng lặp tìm số `nonce` (thông qua mã hóa SHA-256), sau đó gửi kết quả kèm theo request chính (Login, Register, Forgot Password).

Quy trình gồm **4 bước chính** dưới đây:

---

## BƯỚC 1: Lấy thử thách từ Backend (Request Challenge)

Trước khi thực hiện các API yêu cầu Captcha (ví dụ: login, register, forgot-password), FE cần gọi API để lấy token thử thách.

*   **API Endpoint:** `POST /api/v1/request-challenge`
*   **Headers bắt buộc:**
    *   `X-Timestamp`: Unix Timestamp hiện tại của client bằng miligiây (milliseconds), ví dụ: `1688534400000`.
    *   `Signature`: Chữ ký dùng để xác thực request sạch, tránh spam API.
*   **Cách tạo chữ ký `Signature`:**
    Chữ ký là mã hash SHA-256 của chuỗi ghép giữa `X-Timestamp` và một khóa bí mật (client secret key) được cấu hình chung giữa FE và BE (khóa này tương ứng với `base64_decode(config('services.pow.key'))` ở phía BE).

    $$\text{Signature} = \text{sha256}( \text{X-Timestamp} + \text{"\_"} + \text{Client\_Secret} )$$

    *Ví dụ mã JavaScript tạo signature:*
    ```javascript
    const timestamp = Date.now().toString(); // ví dụ: "1719830400000"
    const clientSecret = "YOUR_CLIENT_SECRET_KEY"; // Khóa bí mật cấu hình trên FE
    const message = `${timestamp}_${clientSecret}`;
    const signature = crypto.createHash('sha256').update(message).digest('hex');
    ```

*   **Response trả về từ BE nếu thành công (HTTP 200):**
    ```json
    {
        "success": true,
        "data": {
            "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...", // JWT Token chứa thông tin thử thách
            "difficulty": 5 // Độ khó (Số lượng chữ số '0' bắt buộc ở đầu chuỗi hash kết quả)
        }
    }
    ```

---

## BƯỚC 2: Giải thử thách ở Frontend (Solve Challenge)

Sau khi nhận được `token` và `difficulty` từ Bước 1, FE phải thực hiện tính toán tìm số `nonce` (bắt đầu tăng từ `0`) sao cho:

$$\text{sha256}( \text{token} + \text{nonce} ) \text{ có chuỗi bắt đầu bằng đúng } \text{difficulty} \text{ chữ số } \text{"0"}$$

### Đoạn mã ví dụ bằng JavaScript (Chạy trên trình duyệt):

```javascript
// Hàm tính SHA-256 trên trình duyệt sử dụng Web Crypto API
async function sha256(message) {
    const msgBuffer = new TextEncoder().encode(message);
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
}

// Hàm tìm nonce (Giải Proof of Work)
async function solveChallenge(token, difficulty) {
    const targetPrefix = '0'.repeat(difficulty);
    let nonce = 0;

    console.time("PoW Time");
    while (true) {
        const message = token + nonce;
        const hash = await sha256(message);

        if (hash.startsWith(targetPrefix)) {
            console.timeEnd("PoW Time");
            return nonce; // Tìm thấy nonce thỏa mãn thử thách!
        }

        nonce++;
    }
}
```

---

## BƯỚC 3: Gửi Request API chính kèm kết quả Captcha

Sau khi đã giải được `nonce` (ví dụ: `12345`), FE gửi request chính (ví dụ: Login) và đính kèm 2 tham số:
*   `token`: Token JWT nhận được từ **Bước 1**.
*   `nonce`: Số `nonce` tìm được từ **Bước 2** (kiểu dữ liệu: `string` hoặc `integer`).

*   **API Endpoint:** `POST /api/v1/auth/user/login` (hoặc register/forgot-password)
*   **Body Request:**
    ```json
    {
        "email": "user@example.com",
        "password": "password123",
        "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "nonce": "12345"
    }
    ```

---

## BƯỚC 4: Backend xác thực và xử lý (Verify)

Tại Backend, Middleware `Captcha` sẽ tự động chặn request và thực hiện các bước kiểm tra:
1.  **Kiểm tra tham số:** Đảm bảo request gửi lên có đủ `token` và `nonce`.
2.  **Xác thực tính hợp lệ của Token:** Giải mã `token` bằng JWT key bí mật phía BE. Kiểm tra xem thử thách có bị hết hạn (`exp`) hay không (mặc định thử thách có hiệu lực trong 5 phút).
3.  **Chống tái sử dụng (Replay Attack):** Kiểm tra xem `token` này đã từng được xác thực thành công trước đó chưa (bằng cách lưu cache). Nếu đã dùng rồi, sẽ trả về lỗi `400 Proof of Work challenge already used.`.
4.  **Kiểm tra kết quả toán học:** Ghép `token` + `nonce`, băm SHA-256 và kiểm tra xem có bắt đầu bằng đúng `difficulty` số `0` hay không.
5.  **Cho phép đi tiếp:** Nếu tất cả các bước trên hợp lệ, BE ghi nhận token này đã sử dụng và chuyển request đến Controller xử lý nghiệp vụ chính.