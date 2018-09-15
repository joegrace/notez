<template src='./templates/home.html'></template><script>
    import NoteService from '../../services/NoteService'
    
    
    export default {
        data() {
            return {
                msg: "Hi There!",
                notes: [],
                currentNote: {}
            }
        },
        
        methods: {
            editNote(note) {
                this.currentNote = note
                
                
                
            },
            
            /*
            * This will create a new note
            */
            newNote() {
                this.currentNote = {}
            }
        },
        
        mounted() {
            // Get all notes
            NoteService.getAllNotes().then((notes) => {
                console.log(notes) 
                this.notes = notes
            })
        }
    }
    
</script>