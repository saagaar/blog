<template>
    <a href="#" class="plus-minus">
        <input type="checkbox" :checked="isChecked"    name="a" id="a" class="css-checkbox">
        <label for="a" class="css-label">
          <a href='' @click.prevent="toggleInterest" >
            <span class="fa fa-plus"></span>
            <span class="fa fa-check"></span>
          </a>
        </label>
    </a>
</template>

<script>
    import Form from './../../services/Form.js'
let action='';
    export default {
        name: 'favorite',
        props: ['currentCategory', 'userInterest'],

        data: function() {
            return {
                isChecked:'',
            }
        },

        mounted() {
            var indexval=(this.userInterest.indexOf(this.currentCategory));
            if(indexval==-1)
            {
                this.isChecked=false;
            }else{
                this.isChecked=true;
            }
        },

        methods: {
            toggleInterest:function(){
                if(this.isChecked)
                {
                    action='api/remove/userinterest/'+this.currentCategory;
                    this.isChecked=false;
                }
                else
                {
                    action='api/add/userinterest/'+this.currentCategory;
                      this.isChecked=true;
                } 
                    var form=new Form();
                    form.get(action).then(response => {
                        if (true) {}

                  }).catch(e => {
                      console.log(e);
                  });

            }
            
        }
    }
</script>