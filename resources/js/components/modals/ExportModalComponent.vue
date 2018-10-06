<template src="./templates/exportModal.html"></template><script>
import NotesService from "../../services/NoteService.js"

export default {
    data() {
        return {
            loading: false
        };
    },

    methods: {
        async startExport(bvEvt) {
        this.loading = true;

        // Don't close this modal by default
        bvEvt.preventDefault();

        // Start the export process
        let result = await NotesService.exportNotes();

        // Close the modal
        this.$root.$emit("bv::hide::modal", "exportModal");

        this.loading = false;
        }
    }
};
</script>