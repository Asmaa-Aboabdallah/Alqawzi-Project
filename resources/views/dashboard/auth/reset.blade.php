@extends('dashboard.auth.layout')
@section('title')
    Reset Password - Al-Quzi Foundation
@endsection

@section('main')
    <form class="card card-md" action="{{ url('reset-password') }}" method="post">
        @csrf
        @include('dashboard.inc.msg')
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Reset password</h2>
            <p class="text-muted mb-4">Enter code sent to you and New Password</p>
            <div class="mb-3">
                <label class="form-label">OTP Code</label>
                <input type="text" class="form-control" name="otp">
            </div>
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <div class="input-group input-group-flat">
                    <input type="password" name="password" id="typepass" class="form-control" />
                    <span class="input-group-text">
                        <a onclick="Toggle()" class="link-secondary" title="Show password" data-bs-toggle="tooltip"
                            style="cursor: pointer">
                            <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="12" cy="12" r="2" />
                                <path
                                    d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                            </svg>
                        </a>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <div class="input-group input-group-flat">
                    <input type="password" name="password_confirmation" id="typepassconf" class="form-control" />
                    <span class="input-group-text">
                        <a onclick="Toggle2()" class="link-secondary" title="Show password" data-bs-toggle="tooltip"
                            style="cursor: pointer">
                            <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="12" cy="12" r="2" />
                                <path
                                    d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                            </svg>
                        </a>
                    </span>
                </div>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <polyline points="3 7 12 13 21 7" />
                    </svg> --}}
                    Reset Password
                </button>
            </div>
        </div>
    </form>
    <div class="text-center text-muted mt-3">
         <a href="{{ url('forget') }}">send me code again</a>
    </div>
@endsection

@section('script')
    <script>
        // Change the type of input to password or text
        function Toggle() {
            var temp = document.getElementById("typepass");
            if (temp.type === "password") {
                temp.type = "text";
            } else {
                temp.type = "password";
            }
        }

        function Toggle2() {
            var temp2 = document.getElementById("typepassconf");
            if (temp2.type === "password") {
                temp2.type = "text";
            } else {
                temp2.type = "password";
            }
        }
    </script>
@endsection
