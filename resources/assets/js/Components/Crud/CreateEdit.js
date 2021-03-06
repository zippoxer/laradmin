import Vue from 'vue';
import MixinsLoader from '../../Helpers/MixinsLoader';
import LaForm from '../../Forms/LaForm';
import deleteMixin from '../../Mixins/Delete';
import ServerError from '../../Mixins/ServerError';
import {LaRepeater, LaRepeaterRow} from '../Repeater/index';
import {LaRelationship, LaRelationshipRow} from '../Relationship/index';
import LaFilesUpload from '../FilesUpload/FilesUpload.vue';
import LaImageUpload from '../ImageUpload/ImageUpload.vue';
import LaFileUpload from '../FileUpload/FileUpload.vue';
import TagsField from '../TagsField/TagsField.vue';

export default {

    name: 'CrudCreateEdit',

    props: ['type', 'model'],

    mixins: MixinsLoader.load('crudCreateEdit', [deleteMixin, ServerError]),

    data() {
        return {
            form: new LaForm(window.laradmin.model),
        }
    },

    watch: {

    },

    created() {
        console.log(this.form);
    },

    methods: {
        save() {
            let method = window.laradmin.type.action === 'edit' ? 'put' : 'post';

            this.form[method](window.laradmin.routs.save)
                .then((res) => {
                    if(res.data.redirect) {
                        window.location.href = res.data.redirect;
                    } else {
                        this.$toast.open({
                            message: 'All Changes Saved!',
                            type: 'is-success'
                        });

                        //POC
                        if(this.form.updated_at) {
                            this.form.updated_at = new Date();
                        }
                    }
                })
                .catch(err => {
                    this.$toast.open({
                        message: 'Whoops.. Something went wrong!',
                        type: 'is-danger'
                    });

                    let code = err.status ? err.status : err.code;

                    if(code !== 422) {
                        this.alertServerError(err);
                    }
                });
        },

        deleteModel() {
            this.onDelete(
                window.laradmin.routs.delete,
                window.laradmin.type.singular_name
            );
        }

    },

    computed: {

    },

    components: {
        LaRepeater,
        LaRepeaterRow,
        LaFilesUpload,
        LaRelationship,
        LaRelationshipRow,
        LaImageUpload,
        LaFileUpload,
        TagsField
    }

}