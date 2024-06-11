
// Verifique se há uma mensagem na URL
const params = new URLSearchParams(window.location.search);
const msg = params.get('msg');

if (msg) {
    const msg1 = JSON.parse(decodeURIComponent(msg));

    Swal.fire({
        // icon: status === 'fail' ? 'error' : 'success',
        icon : 'success',
        title: msg1,
        // text: msg1
    });
}
