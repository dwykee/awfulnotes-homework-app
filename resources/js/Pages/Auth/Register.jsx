import { useState } from "react";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Register() {
    const [showPassword, setShowPassword] = useState(false);
    const [showConfirm, setShowConfirm] = useState(false);

    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("register"), {
            onFinish: () => reset("password", "password_confirmation"),
        });
    };

    const inputStyle = (hasError) => ({
        width: "100%",
        padding: "12px 16px",
        background: "#f6faff",
        border: `1px solid ${hasError ? "#ba1a1a" : "#e8bcb6"}`,
        borderRadius: 8,
        fontSize: 16,
        color: "#141d23",
        outline: "none",
        boxSizing: "border-box",
    });

    const inputWithIconStyle = (hasError) => ({
        ...inputStyle(hasError),
        paddingRight: 44,
    });

    return (
        <>
            <Head title="Sign Up" />

            <div className="h-screen w-full overflow-hidden flex antialiased" style={{ fontFamily: "Inter, sans-serif", background: "#f6faff", color: "#141d23" }}>

                {/* Left Side: Features Panel — matches Login's left side style */}
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
                        {/* Logo */}
                        <div className="flex items-center gap-3 mb-12">
                            <img
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjQMO4UN8Nm50p4pSIvARHvavUZJwOXYrpAlChOtWsPiSg6Xv-7c1aQTPHy77UE1Eid0_Tur4Y9p7jrKCRa1_j3RQj3SsQbegntoNg69tOUjR-v6MfgPQLn0R42LLcNiZnw4A3No2Ag5uTrw7gR5e2ISAQNCx5k_xphJd2gjn1gjfRNDCQWVhIcYwS1kAeDpLlMKPWNZMK9E82qffOrwnnvDdeCgj4ZW2Pmls1sDHTgxaqT_SCs-cAVQ2l2zBwdtsi09VdvTcHd_k"
                                alt="awfulnotes logo"
                                style={{ width: 48, height: 48, borderRadius: "50%", objectFit: "contain", background: "#fff", padding: 4 }}
                            />
                            <div>
                                <h1 style={{ fontFamily: "Hanken Grotesk, sans-serif", fontSize: 24, fontWeight: 600, color: "#a30000", margin: 0 }}>awfulnotes</h1>
                                <p style={{ fontSize: 11, letterSpacing: "0.1em", color: "#5e3f3a", textTransform: "uppercase", margin: 0, fontFamily: "JetBrains Mono, monospace" }}>
                                    Lazy Collegers Society
                                </p>
                            </div>
                        </div>

                        {/* Big headline */}
                        <h2 style={{
                            fontFamily: "Hanken Grotesk, sans-serif",
                            fontSize: 48,
                            lineHeight: "56px",
                            fontWeight: 800,
                            letterSpacing: "-0.02em",
                            color: "#141d23",
                            marginBottom: 40,
                        }}>
                            Master your coursework.
                        </h2>

                        {/* Feature List */}
                        <div style={{ display: "flex", flexDirection: "column", gap: 24 }}>
                            {[
                                { icon: "task_alt", title: "Track Assignments", desc: "Keep all your tasks, essays, and reading materials in one centralized, easily accessible hub." },
                                { icon: "event_busy", title: "Never Miss a Deadline", desc: "Clear visual cues and prioritizing ensure you submit everything on time, every time." },
                                { icon: "insights", title: "Monitor Progress", desc: 'Visualize your workload and track your journey from "To Do" to "Done".' },
                            ].map(({ icon, title, desc }) => (
                                <div key={icon} style={{ display: "flex", alignItems: "flex-start", gap: 16 }}>
                                    <div style={{ background: "#d10000", borderRadius: "50%", padding: 8, display: "flex", alignItems: "center", justifyContent: "center", flexShrink: 0 }}>
                                        <span className="material-symbols-outlined" style={{ fontSize: 24, color: "#fff" }}>{icon}</span>
                                    </div>
                                    <div>
                                        <h3 style={{ fontFamily: "Inter, sans-serif", fontSize: 16, fontWeight: 600, color: "#141d23", margin: "0 0 4px" }}>{title}</h3>
                                        <p style={{ fontSize: 14, color: "#5e3f3a", margin: 0, lineHeight: "20px" }}>{desc}</p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Decorative blobs */}
                    <div className="absolute -bottom-24 -left-24 w-96 h-96 rounded-full" style={{ background: "rgba(163,0,0,0.04)", filter: "blur(60px)" }} />
                    <div className="absolute top-1/4 -right-24 w-64 h-64 rounded-full" style={{ background: "rgba(192,0,0,0.04)", filter: "blur(60px)" }} />
                </section>

                {/* Right Side: Registration Form */}
                <section className="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12" style={{ background: "#f6faff" }}>
                    <div className="w-full max-w-[440px]">

                        {/* Header */}
                        <div className="mb-8">
                            <h2 style={{ fontFamily: "Hanken Grotesk, sans-serif", fontSize: 32, fontWeight: 700, color: "#141d23", marginBottom: 8 }}>
                                Create an Account
                            </h2>
                            <p style={{ fontSize: 16, color: "#5e3f3a" }}>
                                Ready to become an Academic Achiever? Sign up below.
                            </p>
                        </div>

                        <form onSubmit={submit} style={{ display: "flex", flexDirection: "column", gap: 20 }}>

                            {/* Full Name */}
                            <div>
                                <label htmlFor="name" style={{ display: "block", fontSize: 12, fontWeight: 600, color: "#141d23", marginBottom: 6 }}>
                                    Full Name
                                </label>
                                <input
                                    id="name"
                                    type="text"
                                    value={data.name}
                                    onChange={(e) => setData("name", e.target.value)}
                                    placeholder="Jane Doe"
                                    required
                                    autoComplete="name"
                                    style={inputStyle(errors.name)}
                                    onFocus={e => e.target.style.boxShadow = "0 0 0 2px #a30000"}
                                    onBlur={e => e.target.style.boxShadow = "none"}
                                />
                                {errors.name && <p style={{ marginTop: 4, fontSize: 12, color: "#ba1a1a" }}>{errors.name}</p>}
                            </div>

                            {/* Email */}
                            <div>
                                <label htmlFor="email" style={{ display: "block", fontSize: 12, fontWeight: 600, color: "#141d23", marginBottom: 6 }}>
                                    Email Address
                                </label>
                                <input
                                    id="email"
                                    type="email"
                                    value={data.email}
                                    onChange={(e) => setData("email", e.target.value)}
                                    placeholder="jane.doe@university.edu"
                                    required
                                    autoComplete="username"
                                    style={inputStyle(errors.email)}
                                    onFocus={e => e.target.style.boxShadow = "0 0 0 2px #a30000"}
                                    onBlur={e => e.target.style.boxShadow = "none"}
                                />
                                {errors.email && <p style={{ marginTop: 4, fontSize: 12, color: "#ba1a1a" }}>{errors.email}</p>}
                            </div>

                            {/* Password */}
                            <div>
                                <label htmlFor="password" style={{ display: "block", fontSize: 12, fontWeight: 600, color: "#141d23", marginBottom: 6 }}>
                                    Password
                                </label>
                                <div className="relative">
                                    <input
                                        id="password"
                                        type={showPassword ? "text" : "password"}
                                        value={data.password}
                                        onChange={(e) => setData("password", e.target.value)}
                                        placeholder="••••••••"
                                        required
                                        autoComplete="new-password"
                                        style={inputWithIconStyle(errors.password)}
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
                                <p style={{ marginTop: 6, fontSize: 12, color: "#5e3f3a", opacity: 0.7 }}>Must be at least 8 characters long.</p>
                                {errors.password && <p style={{ marginTop: 4, fontSize: 12, color: "#ba1a1a" }}>{errors.password}</p>}
                            </div>

                            {/* Confirm Password */}
                            <div>
                                <label htmlFor="password_confirmation" style={{ display: "block", fontSize: 12, fontWeight: 600, color: "#141d23", marginBottom: 6 }}>
                                    Confirm Password
                                </label>
                                <div className="relative">
                                    <input
                                        id="password_confirmation"
                                        type={showConfirm ? "text" : "password"}
                                        value={data.password_confirmation}
                                        onChange={(e) => setData("password_confirmation", e.target.value)}
                                        placeholder="••••••••"
                                        required
                                        autoComplete="new-password"
                                        style={inputWithIconStyle(errors.password_confirmation)}
                                        onFocus={e => e.target.style.boxShadow = "0 0 0 2px #a30000"}
                                        onBlur={e => e.target.style.boxShadow = "none"}
                                    />
                                    <button
                                        type="button"
                                        onClick={() => setShowConfirm(!showConfirm)}
                                        className="absolute inset-y-0 right-0 pr-3 flex items-center"
                                        style={{ color: "#5e3f3a", background: "none", border: "none", cursor: "pointer" }}
                                    >
                                        <span className="material-symbols-outlined" style={{ fontSize: 20 }}>
                                            {showConfirm ? "visibility" : "visibility_off"}
                                        </span>
                                    </button>
                                </div>
                                {errors.password_confirmation && <p style={{ marginTop: 4, fontSize: 12, color: "#ba1a1a" }}>{errors.password_confirmation}</p>}
                            </div>

                            {/* Submit */}
                            <button
                                type="submit"
                                disabled={processing}
                                style={{
                                    width: "100%",
                                    padding: "12px 16px",
                                    border: "none",
                                    borderRadius: 8,
                                    fontSize: 16,
                                    fontWeight: 600,
                                    color: "#fff",
                                    background: processing ? "#936e69" : "#d10000",
                                    cursor: processing ? "not-allowed" : "pointer",
                                    transition: "background 0.2s",
                                    marginTop: 8,
                                }}
                                onMouseEnter={e => { if (!processing) e.target.style.background = "#a30000"; }}
                                onMouseLeave={e => { if (!processing) e.target.style.background = "#d10000"; }}
                            >
                                {processing ? "Creating account..." : "Create Account"}
                            </button>
                        </form>

                        <p className="mt-8 text-center" style={{ fontSize: 14, color: "#5e3f3a" }}>
                            Already have an account?{" "}
                            <Link href={route("login")} style={{ color: "#a30000", fontWeight: 600, textDecoration: "none" }}>
                                Log in here
                            </Link>
                        </p>
                    </div>
                </section>
            </div>
        </>
    );
}