import { useState } from "react";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Login({ status, canResetPassword }) {
    const [showPassword, setShowPassword] = useState(false);

    const { data, setData, post, processing, errors, reset } = useForm({
        email: "",
        password: "",
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("login"), {
            onFinish: () => reset("password"),
        });
    };

    return (
        <>
            <Head title="Login" />

            <div className="h-screen w-full overflow-hidden flex antialiased" style={{ fontFamily: "Inter, sans-serif", background: "#f6faff", color: "#141d23" }}>

                {/* Left Side: Visual */}
                <section className="hidden lg:flex w-1/2 relative items-center justify-center overflow-hidden" style={{ background: "#ecf5fe" }}>
                    {/* Dot pattern */}
                    <div
                        className="absolute inset-0"
                        style={{
                            opacity: 0.08,
                            backgroundImage: "radial-gradient(circle at 2px 2px, #a30000 1px, transparent 0)",
                            backgroundSize: "32px 32px",
                        }}
                    />

                    <div className="relative z-10 p-12 max-w-lg">
                        {/* Icon */}
                        <div className="mb-8">
                            <span className="material-symbols-outlined" style={{ fontSize: 64, color: "#a30000", fontVariationSettings: "'FILL' 1" }}>
                                school
                            </span>
                        </div>

                        {/* Big headline */}
                        <h1 style={{
                            fontFamily: "Hanken Grotesk, sans-serif",
                            fontSize: 48,
                            lineHeight: "56px",
                            fontWeight: 800,
                            letterSpacing: "-0.02em",
                            color: "#141d23",
                            marginBottom: 24,
                        }}>
                            Master your workload.
                            <br />
                            <span style={{ color: "#a30000" }}>Conquer your goals.</span>
                        </h1>

                        <p style={{
                            fontFamily: "Inter, sans-serif",
                            fontSize: 18,
                            lineHeight: "28px",
                            color: "#5e3f3a",
                        }}>
                            awfulnotes is designed for the academic achiever. Streamline
                            your assignments, track your progress, and reclaim your free
                            time with a clear, systematic approach to studying.
                        </p>
                    </div>

                    {/* Decorative blobs */}
                    <div className="absolute -bottom-24 -left-24 w-96 h-96 rounded-full" style={{ background: "rgba(163,0,0,0.04)", filter: "blur(60px)" }} />
                    <div className="absolute top-1/4 -right-24 w-64 h-64 rounded-full" style={{ background: "rgba(192,0,0,0.04)", filter: "blur(60px)" }} />
                </section>

                {/* Right Side: Login Form */}
                <section className="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12" style={{ background: "#f6faff" }}>
                    <div className="w-full max-w-[400px]">

                        {/* Header */}
                        <div className="text-center mb-10">
                            <div className="inline-flex items-center justify-center mb-6">
                                <img
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjQMO4UN8Nm50p4pSIvARHvavUZJwOXYrpAlChOtWsPiSg6Xv-7c1aQTPHy77UE1Eid0_Tur4Y9p7jrKCRa1_j3RQj3SsQbegntoNg69tOUjR-v6MfgPQLn0R42LLcNiZnw4A3No2Ag5uTrw7gR5e2ISAQNCx5k_xphJd2gjn1gjfRNDCQWVhIcYwS1kAeDpLlMKPWNZMK9E82qffOrwnnvDdeCgj4ZW2Pmls1sDHTgxaqT_SCs-cAVQ2l2zBwdtsi09VdvTcHd_k"
                                    alt="awfulnotes logo"
                                    className="h-16 w-auto object-contain"
                                />
                            </div>
                            <h2 style={{ fontFamily: "Hanken Grotesk, sans-serif", fontSize: 32, fontWeight: 700, color: "#141d23", marginBottom: 8 }}>
                                Welcome back
                            </h2>
                            <p style={{ fontSize: 16, color: "#5e3f3a" }}>
                                Enter your details to access your dashboard.
                            </p>
                        </div>

                        {/* Status message */}
                        {status && (
                            <div className="mb-4 text-sm font-medium px-4 py-3 rounded-lg" style={{ color: "#166534", background: "#f0fdf4" }}>
                                {status}
                            </div>
                        )}

                        {/* Form */}
                        <form onSubmit={submit} className="space-y-6">

                            {/* Email */}
                            <div>
                                <label htmlFor="email" style={{ display: "block", fontSize: 12, fontWeight: 600, color: "#141d23", marginBottom: 4 }}>
                                    Email
                                </label>
                                <div className="relative">
                                    <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none" style={{ color: "#5e3f3a" }}>
                                        <span className="material-symbols-outlined" style={{ fontSize: 20 }}>mail</span>
                                    </div>
                                    <input
                                        id="email"
                                        type="email"
                                        value={data.email}
                                        onChange={(e) => setData("email", e.target.value)}
                                        placeholder="student@university.edu"
                                        required
                                        autoComplete="username"
                                        style={{
                                            display: "block",
                                            width: "100%",
                                            paddingLeft: 40,
                                            paddingRight: 12,
                                            paddingTop: 12,
                                            paddingBottom: 12,
                                            background: "#fff",
                                            border: `1px solid ${errors.email ? "#ba1a1a" : "#e8bcb6"}`,
                                            borderRadius: 8,
                                            fontSize: 16,
                                            color: "#141d23",
                                            outline: "none",
                                            boxSizing: "border-box",
                                        }}
                                        onFocus={e => e.target.style.boxShadow = "0 0 0 2px #a30000"}
                                        onBlur={e => e.target.style.boxShadow = "none"}
                                    />
                                </div>
                                {errors.email && <p style={{ marginTop: 4, fontSize: 12, color: "#ba1a1a" }}>{errors.email}</p>}
                            </div>

                            {/* Password */}
                            <div>
                                <div className="flex items-center justify-between" style={{ marginBottom: 4 }}>
                                    <label htmlFor="password" style={{ fontSize: 12, fontWeight: 600, color: "#141d23" }}>
                                        Password
                                    </label>
                                    {canResetPassword && (
                                        <Link href={route("password.request")} style={{ fontSize: 12, fontWeight: 600, color: "#a30000", textDecoration: "none" }}>
                                            Forgot Password?
                                        </Link>
                                    )}
                                </div>
                                <div className="relative">
                                    <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none" style={{ color: "#5e3f3a" }}>
                                        <span className="material-symbols-outlined" style={{ fontSize: 20 }}>lock</span>
                                    </div>
                                    <input
                                        id="password"
                                        type={showPassword ? "text" : "password"}
                                        value={data.password}
                                        onChange={(e) => setData("password", e.target.value)}
                                        placeholder="••••••••"
                                        required
                                        autoComplete="current-password"
                                        style={{
                                            display: "block",
                                            width: "100%",
                                            paddingLeft: 40,
                                            paddingRight: 44,
                                            paddingTop: 12,
                                            paddingBottom: 12,
                                            background: "#fff",
                                            border: `1px solid ${errors.password ? "#ba1a1a" : "#e8bcb6"}`,
                                            borderRadius: 8,
                                            fontSize: 16,
                                            color: "#141d23",
                                            outline: "none",
                                            boxSizing: "border-box",
                                        }}
                                        onFocus={e => e.target.style.boxShadow = "0 0 0 2px #a30000"}
                                        onBlur={e => e.target.style.boxShadow = "none"}
                                    />
                                    <button
                                        type="button"
                                        onClick={() => setShowPassword(!showPassword)}
                                        className="absolute inset-y-0 right-0 pr-3 flex items-center"
                                        style={{ color: "#5e3f3a", background: "none", border: "none", cursor: "pointer" }}
                                    >
                                        <span className="material-symbols-outlined" style={{ fontSize: 20 }}>
                                            {showPassword ? "visibility" : "visibility_off"}
                                        </span>
                                    </button>
                                </div>
                                {errors.password && <p style={{ marginTop: 4, fontSize: 12, color: "#ba1a1a" }}>{errors.password}</p>}
                            </div>

                            {/* Remember Me */}
                            <div className="flex items-center">
                                <input
                                    id="remember-me"
                                    type="checkbox"
                                    checked={data.remember}
                                    onChange={(e) => setData("remember", e.target.checked)}
                                    style={{ height: 16, width: 16, accentColor: "#a30000", cursor: "pointer" }}
                                />
                                <label htmlFor="remember-me" style={{ marginLeft: 8, fontSize: 14, color: "#5e3f3a", cursor: "pointer" }}>
                                    Remember me for 30 days
                                </label>
                            </div>

                            {/* Submit */}
                            <button
                                type="submit"
                                disabled={processing}
                                style={{
                                    width: "100%",
                                    display: "flex",
                                    justifyContent: "center",
                                    padding: "12px 16px",
                                    border: "none",
                                    borderRadius: 8,
                                    fontSize: 12,
                                    fontWeight: 600,
                                    color: "#fff",
                                    background: processing ? "#936e69" : "#d10000",
                                    cursor: processing ? "not-allowed" : "pointer",
                                    transition: "background 0.2s",
                                }}
                                onMouseEnter={e => { if (!processing) e.target.style.background = "#a30000"; }}
                                onMouseLeave={e => { if (!processing) e.target.style.background = "#d10000"; }}
                            >
                                {processing ? "Signing in..." : "Sign In"}
                            </button>
                        </form>

                        {/* Divider */}
                        <div className="mt-8 relative">
                            <div className="absolute inset-0 flex items-center">
                                <div className="w-full" style={{ borderTop: "1px solid #e8bcb6" }} />
                            </div>
                            <div className="relative flex justify-center">
                                <span style={{ paddingLeft: 8, paddingRight: 8, background: "#f6faff", fontSize: 12, fontWeight: 600, color: "#5e3f3a" }}>
                                    Or continue with
                                </span>
                            </div>
                        </div>

                        {/* SSO Buttons */}
                        <div className="mt-6 grid grid-cols-2 gap-3">
                            <button type="button" style={{ display: "flex", justifyContent: "center", alignItems: "center", padding: "10px 16px", border: "1px solid #e8bcb6", borderRadius: 8, background: "#fff", fontSize: 12, fontWeight: 600, color: "#141d23", cursor: "pointer" }}>
                                <svg className="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none">
                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                </svg>
                                Google
                            </button>
                            <button type="button" style={{ display: "flex", justifyContent: "center", alignItems: "center", padding: "10px 16px", border: "1px solid #e8bcb6", borderRadius: 8, background: "#fff", fontSize: 12, fontWeight: 600, color: "#141d23", cursor: "pointer" }}>
                                <span className="material-symbols-outlined mr-2" style={{ fontSize: 20 }}>school</span>
                                Institution
                            </button>
                        </div>

                        {/* Footer */}
                        <p className="mt-10 text-center" style={{ fontSize: 14, color: "#5e3f3a" }}>
                            Don't have an account?{" "}
                            <Link href={route("register")} style={{ fontSize: 12, fontWeight: 600, color: "#a30000", textDecoration: "none" }}>
                                Sign up for free
                            </Link>
                        </p>
                    </div>
                </section>
            </div>
        </>
    );
}