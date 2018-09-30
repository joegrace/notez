<template src='./templates/home.html'></template><script>
    import NoteService from '../../services/NoteService'
import { clearInterval } from 'timers';
    
    
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
                    
                    if (note.tags == undefined)
                        note.tags = []
                    
                    note.tags.forEach((t) => {
                        if (t.text.toLowerCase() == component.tagFilter.toLowerCase()) {
                            result = true
                        }
                    })
                    
                    let reg = component.tagFilter
                    let re = new RegExp(reg, 'i');
                    
                    if (note.title.match(re))
                        result = true
                    
                    return result
                })
            }
        },
        
        methods: {
            editNote(note) {
                this.currentNote = note
                this.currentNote.dirty = false
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
                let result = await NoteService.saveNote(note)
                
                if (result.constructor.name == 'Object') {
                    // Is this a new note? If so, get all notes.
                    if (this.currentNote.id == undefined) {
                        console.log(this.currentNote.id)
                        this.getAllNotes()
                        this.currentNote = result;
                    }

                    this.currentNote.dirty = false;
                } else {
                    console.log("Save result not true: " + result);
                }
            },
            
            /*
            * Delete
            */
            async deleteNote(note) {
                let result = await NoteService.deleteNote(note)
                
                if (result == true) {
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
                let serviceResult = await NoteService.getAllNotes()
                
                this.notes = serviceResult
            },
            
        },
        
        async mounted() {
            let component = this
            await component.getAllNotes()

            // Check for dirty note and save every 5s.
            component.$options.noteSaveInterval = setInterval(async () => {
                // We only want to auto-save notes that have been saved
                // at least once
                if (component.currentNote.id == undefined)
                    return

                if (component.currentNote.dirty != undefined && component.currentNote.dirty === true) {
                    // Form is dirty, save.
                    console.log("Saving dirty note")
                    await component.saveNote(component.currentNote)
                    component.currentNote.dirty = false
                } 
            }, 15000)


        },

        /*
         * Make sure to clear the interval when we change routes.
         * I /think/ this is suppose to work. Gotta test this.
         */
        beforeDestroy() {
            clearInterval(this.$options.noteSaveInterval)
        },


        watch: {
            currentNote: {
                handler(newVal, oldVal) {
                    if (this.currentNote.dirty === false || this.currentNote.dirty == undefined) {

                        this.currentNote.dirty = true
                    }
                },
                deep: true
            }
        }
    }
    
</script>