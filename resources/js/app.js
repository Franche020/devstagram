import Dropzone from "dropzone";

// Comprobacion para si dropzone existe
if(document.getElementById('dropzone')){

    Dropzone.autoDiscover = false;
    let uploadedImg = "";
    
    const dropzone = new Dropzone('#dropzone', {
        dictDefaultMessage: 'Sube tu Imagen',
        acceptedFiles: '.png,.jpg,.jpeg,.gif',
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar Archivo',
        maxFiles: 1,
        uploadMultiple: false,
    
        init: function() {
            if(document.querySelector('[name="imagen"]').value.trim()){
                const fileName = document.querySelector('[name="imagen"]').value.trim()
                const file = {name: fileName, size: 1234, url:`/uploads/${fileName}`};  
                
                let mockfile = {
                    name: file.name,
                    size: file.size,
                };
    
                this.displayExistingFile(mockfile, file.url);
            }
        }
    })
    
    
    dropzone.on('success', function(file,response){
        uploadedImg = response.imagen;
        //console.log(response.imagen);
        document.querySelector('[name="imagen"]').value = response.imagen;
    
    })
    
    dropzone.on('removedfile',function(file,message){
        console.log(uploadedImg);
        document.querySelector('[name="imagen"]').value = "";
    
        // Todo ELIMINAR FOTO uploadedImg Recomendado comprobar la ID del usuario y que la imagen no este asociada a ninguna otra ID
    })
}// Fin dropzone