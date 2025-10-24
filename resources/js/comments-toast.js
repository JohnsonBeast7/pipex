window.addEventListener('toast', event => {
    const type = event.detail.type;
    const message = event.detail.message;
    switch(type) {
        case 'success': 
            Swal.fire({
                toast: true,
                icon: "success", 
                iconColor: "#0084d1", 
                title: message,
                position: "bottom",
                background: "#0ea5e9",
                color: "#fff",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    margin: 'magin-bottom: 10px;'
                }
            }); 
            break; 
        case 'error': 
            Swal.fire({
                toast: true,
                icon: "error", 
                iconColor: "#0084d1", 
                title: message,
                position: "bottom",
                background: "#0ea5e9",
                color: "#fff",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    margin: 'magin-bottom: 10px;'
                }
            }); 
            break; 
    }                      
});