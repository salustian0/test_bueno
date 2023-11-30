document.addEventListener('DOMContentLoaded', function(){
    const frmDelete = document.querySelector('#frm-delete');
    const btnYes = document.querySelector('#btn-yes');
    const modalDelete = document.querySelector('#modalDelete')


    modalDelete.addEventListener('shown.bs.modal', (e) => {
        const btnTrigger = e.relatedTarget;
        if(btnTrigger){
            const id = btnTrigger.getAttribute('id')
            frmDelete.action = `${currentUrl}/${id}`;
        }
    });

    if(btnYes){
        btnYes.addEventListener('click', () => {
            if(frmDelete)
                frmDelete.submit();
        })
    }
})
