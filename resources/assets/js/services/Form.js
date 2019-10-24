import config from './../config/config.js';

export default class Form {

        	 constructor(data=false) 
        	 {
                if(data)
                {
                   this.originalData = data;
                    for (let field in data) {
                        this[field] = data[field];
                    }  
                }
                else{
                    this.originalData='';
                }
                this.errors={};
             }

            /**
             * Reset the form fields.
             */
            reset() {
                for (let field in this.originalData) {
                    this[field] = '';
                }

                // this.errors.clear();
            }

        	/**
             * Fetch all relevant data for the form.
             */ 
            data() {
                
                  let data = {};
                  let form=this;
                 let ndata=this.originalData;
                   if(this.originalData.file)
                   {
                        let formdata=new FormData();
                    
                    for(let property in ndata) {
                        if(form[property] instanceof Array) {
                            return this.createFormData(formdata,form[property],'tags');
                        }
                        else{
                             formdata.append(property, form[property]);
                        }
                    }
                   }
                   else{
                          for (let property in this.originalData) {
                           data[property] = this[property];

                        }
                   }
              
                return data;
            }

             createFormData(form, data, key) {
                var fd=form ;
                if ( ( typeof data === 'object' && data !== null ) || Array.isArray(data) ) {
                    for ( let i in data ) {

                        if ( ( typeof data[i] === 'object' && data[i] !== null ) || Array.isArray(data[i]) ) {
                            this.createFormData(fd, data[i], key + '[' + i + ']');
                        } else {
                            console.log(fd);
                            
                             fd.append(key + '[' + i + ']', data[i]);
                        }
                    }
                } else {
                    fd.append(key, data);
                }
                 console.log(fd);
                return fd;
            }


            // toFormData(obj={}, form='', namespace='') {
            //   var fd =form || new FormData();

            //   var formKey;
            //   // var obj=this.originalData;
           
            //   for(let property in obj) {
            //     // if(obj.hasOwnProperty(property) && obj[property]) {
            //         formKey=property
            //         if (this[property] instanceof Date) {
            //           fd.append(formKey, this[property].toISOString());
            //         } 
            //         else if (this[property] instanceof Array) {
            //           formKey = formKey + '[]'
            //           this[property].forEach(element => {
            //             console.log(formKey);
            //             console.log(this[property]);
            //             fd.append(formKey, JSON.stringify(this[property]))
            //             // fd.append(formKey, this[property]);
            //           })
            //         } 
            //         else if (typeof this[property] === 'object' && !(this[property] instanceof File)) {
            //           this.toFormData(obj[property], fd, formKey);
            //         } else { // if it's a string or a File object
            //           fd.append(formKey, this[property]);
            //         }
            //          // if (namespace) {
            //          //    formKey = namespace + '[' + property + ']';
            //          //  } else {
            //          //      formKey = property;
            //          //  }
            //          //  // if the property is an object, but not a File, use recursivity.
            //          //  if (obj[property] instanceof Date) {
            //          //    fd.append(formKey, obj[property].toISOString());
            //          //  }
            //          //  else if (typeof obj[property] === 'object' && !(obj[property] instanceof File)) {
            //          //    this.toFormData(obj[property], fd, formKey);
            //          //  } else { // if it's a string or a File object
            //          //    fd.append(formKey, obj[property]);
            //          //  }
            //     // }
            //   }
            //   return fd;
                
            // };

            record(errors) {
                this.errors = errors;
            }

            /**
             * Send a POST request to the given URL.
             * .
             * @param {string} url
             */
            get(url) {
                return this.submit('get', url);
            }
        	/**
             * Send a POST request to the given URL.
             * .
             * @param {string} url
             */
            post(url) {
                return this.submit('post', url);
            }

            /**
             * Send a PUT request to the given URL.
             * .
             * @param {string} url
             */
            put(url) {
                return this.submit('put', url);
            }

            /**
             * Send a PATCH request to the given URL.
             * .
             * @param {string} url
             */
            patch(url) {
                return this.submit('patch', url);
            }

            /**
             * Send a DELETE request to the given URL.
             * .
             * @param {string} url
             */
            delete(url) {
                return this.submit('delete', url);
            }

            /**
             * Submit the form.
             *
             * @param {string} requestType
             * @param {string} url
             */
        	submit(requestType, url) {
                
                return new Promise((resolve, reject) => {
                     window.axios.defaults.headers.common = {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    };
                    //if form contains any file it must be form  data
                    var fullUrl = config.ROOT_URL+'/'+url;
                     window.axios[requestType](fullUrl, this.data())
                        .then(response => {
                            this.onSuccess(response.data);
                            resolve(response);
                        })
                        .catch(error => {
                            this.onFail(error.response.data);
                            reject(error.response.data);
                        });
                });
            }


            /**
             * Handle a successful form submission.
             *
             * @param {object} data
             */
            onSuccess(data) {

                // this.reset();
            }


            /**
             * Handle a failed form submission.
             *
             * @param {object} errors
             */
            onFail(errors) {
                this.record(errors);
            }
      
  }


