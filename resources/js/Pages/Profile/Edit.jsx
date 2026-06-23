import { useState, useRef } from "react";
import { Head, Link, useForm, usePage, router } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

const T = {
    primary: "#800020", accent: "#A0002A",
    bg: "#FFFFFF", surfaceAlt: "#F5E6EA",
    border: "#E0E0E0",
    text: "#1a1a1a", textMid: "#800020", textMute: "#C48A96",
    inputBg: "#FDF5F7",
};

function iStyle(extra = {}) {
    return {
        width: "100%", padding: "10px 13px", fontSize: 13, borderRadius: 8,
        border: `1.5px solid ${T.border}`, background: T.inputBg,
        color: T.text, outline: "none", boxSizing: "border-box", ...extra,
    };
}

export default function Edit() {
    const { auth } = usePage().props;
    const user = auth.user;

    const fileInputRef = useRef(null);
    const [preview, setPreview] = useState(user?.avatar_url || null);
    const [uploading, setUploading] = useState(false);

    const { data, setData, patch, processing, errors, recentlySuccessful } = useForm({
        name: user?.name || "",
        email: user?.email || "",
    });

    const initials = (user?.name || "?")
        .split(" ").map(n => n[0]).slice(0, 2).join("").toUpperCase();

    const handleAvatarChange = (e) => {
        const file = e.target.files[0];
        if (!file) return;
        if (!file.type.startsWith("image/")) { alert("File harus berupa gambar!"); return; }
        if (file.size > 2 * 1024 * 1024) { alert("Ukuran file maksimal 2MB!"); return; }

        const reader = new FileReader();
        reader.onload = ev => setPreview(ev.target.result);
        reader.readAsDataURL(file);

        const formData = new FormData();
        formData.append("avatar", file);

        setUploading(true);
        router.post(route("profile.avatar.update"), formData, {
            forceFormData: true,
            preserveScroll: true,
            onFinish: () => setUploading(false),
            onError: () => setPreview(user?.avatar_url || null),
        });
    };

    const submit = (e) => {
        e.preventDefault();
        patch(route("profile.update"));
    };

        const handleLogout = () => {
        if (confirm("Yakin mau keluar dari akun?")) {
            router.post(route("logout"));
        }
    };

    return (
        <AuthenticatedLayout>
            <Head title="Profil Saya" />
            <style>{`.avatar-edit-box:hover .avatar-edit-overlay { opacity: 1; }`}</style>

            <div style={{ minHeight: "100vh", background: T.surfaceAlt, fontFamily: "'Inter', system-ui, sans-serif", padding: "32px 16px" }}>
                <div style={{ maxWidth: 560, margin: "0 auto" }}>
                    <Link href={route("assignments.index")} style={{ display: "inline-flex", alignItems: "center", gap: 6, fontSize: 13, fontWeight: 600, color: T.textMid, textDecoration: "none", marginBottom: 16 }}>
                        ← Back to Dashboard
                    </Link>

                    <div style={{ background: "#fff", borderRadius: 20, padding: 28, boxShadow: "0 4px 24px rgba(128,0,32,0.08)", border: `1px solid ${T.border}` }}>
                        <h1 style={{ fontSize: 19, fontWeight: 800, color: T.text, marginBottom: 4 }}>Profil Saya</h1>
                        <p style={{ fontSize: 12, color: T.textMute, marginBottom: 24 }}>Kelola nama dan foto profil kamu.</p>

                        {/* Avatar */}
                        <div style={{ display: "flex", alignItems: "center", gap: 16, marginBottom: 28 }}>
                            <div className="avatar-edit-box" onClick={() => fileInputRef.current?.click()}
                                style={{ position: "relative", width: 76, height: 76, borderRadius: "50%", flexShrink: 0, cursor: "pointer", overflow: "hidden", background: T.surfaceAlt, display: "flex", alignItems: "center", justifyContent: "center", border: `2px solid ${T.border}` }}>
                                {preview ? (
                                    <img src={preview} alt="Avatar" style={{ width: "100%", height: "100%", objectFit: "cover" }} />
                                ) : (
                                    <span style={{ fontSize: 26, fontWeight: 800, color: T.primary }}>{initials}</span>
                                )}
                                <div className="avatar-edit-overlay" style={{ position: "absolute", inset: 0, background: "rgba(0,0,0,0.45)", display: "flex", alignItems: "center", justifyContent: "center", opacity: 0, transition: "opacity 0.15s", fontSize: 22, color: "#fff" }}>
                                    {uploading ? "⏳" : "📷"}
                                </div>
                                <input ref={fileInputRef} type="file" accept="image/*" onChange={handleAvatarChange} style={{ display: "none" }} />
                            </div>
                            <div>
                                <div style={{ fontSize: 14, fontWeight: 700, color: T.text }}>{user?.name}</div>
                                <div style={{ fontSize: 12, color: T.textMute, marginTop: 2 }}>{user?.email}</div>
                                <button type="button" onClick={() => fileInputRef.current?.click()}
                                    style={{ marginTop: 8, fontSize: 11, fontWeight: 700, padding: "5px 12px", borderRadius: 20, border: `1px solid ${T.border}`, background: T.surfaceAlt, color: T.textMid, cursor: "pointer" }}>
                                    {uploading ? "Mengunggah..." : "Ganti Foto"}
                                </button>
                            </div>
                        </div>

                        {/* Name / Email form */}
                        <form onSubmit={submit}>
                            <div style={{ marginBottom: 14 }}>
                                <label style={{ fontSize: 11, fontWeight: 700, color: T.textMid, display: "block", marginBottom: 5, textTransform: "uppercase", letterSpacing: "0.07em" }}>Nama</label>
                                <input value={data.name} onChange={e => setData("name", e.target.value)} style={iStyle()} />
                                {errors.name && <div style={{ fontSize: 11, color: "#EF4444", marginTop: 4 }}>{errors.name}</div>}
                            </div>
                            <div style={{ marginBottom: 18 }}>
                                <label style={{ fontSize: 11, fontWeight: 700, color: T.textMid, display: "block", marginBottom: 5, textTransform: "uppercase", letterSpacing: "0.07em" }}>Email</label>
                                <input type="email" value={data.email} onChange={e => setData("email", e.target.value)} style={iStyle()} />
                                {errors.email && <div style={{ fontSize: 11, color: "#EF4444", marginTop: 4 }}>{errors.email}</div>}
                            </div>
                            {/* Logout */}
                            <div style={{ marginBottom: 24, marginTop: 24, paddingTop: 20, borderTop: `1px solid ${T.border}` }}>
                                <button type="button" onClick={handleLogout}
                                    style={{ width: "100%", padding: "10px 22px", borderRadius: 10, background: "#fff", border: `1.5px solid ${T.accent}`, color: T.accent, fontSize: 13, fontWeight: 700, cursor: "pointer", display: "flex", alignItems: "center", justifyContent: "center", gap: 8 }}>
                                    ⎋ Keluar (Logout)
                                </button>
                            </div>

                            <div style={{ display: "flex", alignItems: "center", gap: 12 }}>
                                <button type="submit" disabled={processing}
                                    style={{ padding: "10px 22px", borderRadius: 10, background: T.primary, border: "none", color: "#fff", fontSize: 13, fontWeight: 700, cursor: processing ? "not-allowed" : "pointer", opacity: processing ? 0.7 : 1 }}>
                                    {processing ? "Menyimpan..." : "Simpan Perubahan"}
                                </button>
                                {recentlySuccessful && <span style={{ fontSize: 12, color: "#10B981", fontWeight: 600 }}>✓ Tersimpan</span>}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}