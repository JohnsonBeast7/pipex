window.confirmDelete = function(prefix, id) {
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
            document.getElementById(`${prefix}${id}`).submit();
        }
    });
}

window.confirmDeleteLivewire = function(id) {
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
            Livewire.dispatch('commentDelete', { id });
        }
    });
}


