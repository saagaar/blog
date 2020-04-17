export default class UploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

 upload() {
    return this.loader.file
        .then( uploadedFile => {
            return new Promise( ( resolve, reject ) => {
            const data = new FormData();
            data.append( 'image', uploadedFile );
            data.append('code',window.blogCode);

            axios( {
                url: '/blog/add?media=yes',
                method: 'post',
                data,
                headers: {
                    'Content-Type': 'multipart/form-data;'
                },
                withCredentials: false
            } ).then( response => {
                
                if ( response.data.status) {
                    window.blogCode=response.data.code
                    resolve( {
                        default: response.data.url,
                       
                    } );
                } 
                else {
                    reject( response.data.message );
                }
            } ).catch( response => {
                reject( 'Upload failed' );
            } );

        } );
    } );
}

    abort() {
    }
}   