<template src='./templates/home.html'></template><script>
    import NoteService from '../../services/NoteService'
    
    
    export default {
        data() {
            return {
                msg: "Hi There!",
                notes: [],
                currentNote: {},
                newTag: '',
                tagFilter: ''
            }
        },
        
        computed: {
            notesFilter() {
                let component = this
                
                if (component.tagFilter == '') {
                    return component.notes
                }
                
                return this.notes.filter((note) => {
                    let result = false
                    
                    note.tags.forEach((t) => {
                        if (t.text.toLowerCase() == component.tagFilter.toLowerCase()) {
                            result = true
                        }
                    })
                    
                    if (note.title.toLowerCase() == component.tagFilter.toLowerCase())
                        result = true
                    
                    return result
                })
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
            
            /*
            * Remove a tag from current note
            */
            removeTag(note, tag) {
                console.log('Removing tag: ' + tag.text)
                let tagIndex = note.tags.indexOf(tag)
                
                note.tags.splice(tagIndex, 1)
            },
            
            /*
            * Add new tag to current note
            */
            addTag() {
                if (this.currentNote.tags == undefined)
                    this.currentNote.tags = []
                
                this.currentNote.tags.push({text: this.newTag})
                this.newTag = ''
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