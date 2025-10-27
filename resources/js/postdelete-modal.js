window.deletePost = function(id) {
    Swal.fire({
        title: 'Tem certeza?',
        text: 'Esta ação não poderá ser desfeita!',
        color: "#ffffff",
        icon: 'warning',
        iconColor: '#0ea5e9',
        showCancelButton: true,
        background: "#1f2937",
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#0ea5e9'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`deletePost${id}`).submit();
        }
    });
}
