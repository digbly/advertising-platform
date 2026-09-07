/**
 * Auth module JS
 * - Password visibility toggle
 * - jQuery Validation cho các form auth
 */
import $ from 'jquery';
import 'jquery-validation';

/**
 * Cấu hình validation cho từng form auth.
 * Key khớp với giá trị của thuộc tính `data-validate` trên <form>.
 */
const validators = {
    login: {
        rules: {
            email: { required: true, email: true },
            password: { required: true },
        },
        messages: {
            email: {
                required: 'Please enter your email.',
                email: 'Please enter a valid email address.',
            },
            password: {
                required: 'Please enter your password.',
            },
        },
    },
    register: {
        rules: {
            name: { required: true, minlength: 2 },
            email: { required: true, email: true },
            password: { required: true, minlength: 8 },
            password_confirmation: { required: true, equalTo: '#password' },
        },
        messages: {
            name: {
                required: 'Please enter your full name.',
                minlength: 'Your name must be at least 2 characters.',
            },
            email: {
                required: 'Please enter your email.',
                email: 'Please enter a valid email address.',
            },
            password: {
                required: 'Please enter a password.',
                minlength: 'Your password must be at least 8 characters.',
            },
            password_confirmation: {
                required: 'Please confirm your password.',
                equalTo: 'Passwords do not match.',
            },
        },
    },
    'forgot-password': {
        rules: {
            email: { required: true, email: true },
        },
        messages: {
            email: {
                required: 'Please enter your email.',
                email: 'Please enter a valid email address.',
            },
        },
    },
    'reset-password': {
        rules: {
            email: { required: true, email: true },
            password: { required: true, minlength: 8 },
            password_confirmation: { required: true, equalTo: '#password' },
        },
        messages: {
            email: {
                required: 'Please enter your email.',
                email: 'Please enter a valid email address.',
            },
            password: {
                required: 'Please enter a new password.',
                minlength: 'Your password must be at least 8 characters.',
            },
            password_confirmation: {
                required: 'Please confirm your password.',
                equalTo: 'Passwords do not match.',
            },
        },
    },
};

$(function () {
    document.querySelectorAll('[data-password-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const input = document.getElementById(button.dataset.passwordToggle);
            if (!input) return;

            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';

            // Swap icon
            button.innerHTML = isHidden
                ? '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>'
                : '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>';
        });
    });

    // ===== jQuery Validation =====
    $('[data-validate]').each(function () {
        const $form = $(this);
        const config = validators[$form.data('validate')];
        if (!config) return;

        $form.validate({
            errorElement: 'p',
            errorClass: 'validate-error',
            rules: config.rules,
            messages: config.messages,
            errorPlacement: function (error, element) {
                // Đặt thông báo lỗi ngay sau wrapper chứa input
                element.parent().append(error);
            },
            highlight: function (element) {
                $(element).addClass('validate-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('validate-invalid');
            },
        });
    });
});
