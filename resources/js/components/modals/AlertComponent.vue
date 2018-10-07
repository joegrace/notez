<template src="./templates/alertModal.html"></template><script>
export default {
    data() {
        return {
            
        }
    },

    computed: {
        message() {
            return this.$root.alertModalMessage
        },
        title() {
            return this.$root.alertModalTitle
        },
        headerVariant() {
            return function() {
                return this.$root.alertModalHeaderVariant
            }
        },
        modalType() {
            return this.$root.alertModalType
        }
    },

    methods: {
        closeAlert() {
            this.$root.$emit("bv::hide::modal", "alertModal")
        },

        confirmYes() {
            this.$root.alertModalConfirmLastValue = true;
            this.$root.$emit("bv::hide::modal", "alertModal")
        },

        confirmNo() {
            this.$root.alertModalConfirmLastValue = false;
            this.$root.$emit("bv::hide::modal", "alertModal")
        }
    }



}</script>