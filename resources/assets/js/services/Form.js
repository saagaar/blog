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

                this.errors.clear();
            }

        	/**
             * Fetch all relevant data for the form.
             */ 
            data() {
                let data = {};

                for (let property in this.originalData) {
                    data[property] = this[property];
                }

                return data;
            }

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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    };
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


