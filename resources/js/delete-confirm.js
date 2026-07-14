document.addEventListener("DOMContentLoaded", function () {
    document.body.addEventListener("submit", function (e) {
        const form = e.target;

        if (form.classList.contains("delete-form")) {
            e.preventDefault();

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f43f5e",
                cancelButtonColor: "#64748b",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                customClass: {
                    popup: "rounded-xl border border-slate-100 shadow-lg font-sans p-6 bg-white",
                    title: "text-lg font-bold text-slate-800",
                    htmlContainer: "text-sm text-slate-500 my-2",
                    confirmButton:
                        "px-4 py-2.5 rounded-lg text-white font-medium text-sm transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-rose-500",
                    cancelButton:
                        "px-4 py-2.5 rounded-lg text-white font-medium text-sm transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-slate-500",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});
