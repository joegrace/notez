<template src="./templates/changePassword.html"></template><script>

import { required, sameAs } from 'vuelidate/lib/validators'
import UserService from '../../services/UserService'
import Alert from '../../services/Alert'

export default {

    data() {
        return {
            password: '',
            passwordConfirm: ''
        }
    },

    methods: {
        async changePassword() {
            let result =  await UserService.changePassword({
                password: this.password,
                passwordConfirm: this.passwordConfirm
            })

            console.log('result is: ' + result.message)
            Alert.notify('Password Save', 'Your password has been updated successfully.')


            if (result.success === true) {
                this.resetForm()
                this.$root.$emit("bv::hide::modal", "changePasswordModal")
            }
        },

        hideModal() {
            this.resetForm()
        },

        resetForm() {
            // Clear out form and reset
            this.password = ''
            this.passwordConfirm = ''
            this.$nextTick(() => { this.$v.$reset() })
        }
    },

    validations: {
        password: {
            required
        },
        passwordConfirm: {
            required,
            sameAsPassword: sameAs('password')
        }
    }




}



</script>