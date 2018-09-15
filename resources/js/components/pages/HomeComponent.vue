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
                this.currentNote = {
                    note: ''
                }
            },
            
            /*
            * This will save the current note
            */
            async saveNote(note) {
                console.log('saving')
                
                let result = await NoteService.saveNote(note)
                
                if (result)
                    this.getAllNotes()
            },
            
            /*
            * Delete
            */
            async deleteNote(note) {
                let result = await NoteService.deleteNote(note)
                
                if (result) {
                    console.log('Note deleted')
                    this.getAllNotes()
                }
            },
            
            async getAllNotes() {
                this.notes = await NoteService.getAllNotes()
            }
        },
        
        async mounted() {
            await this.getAllNotes()
        }
    }
    
</script>