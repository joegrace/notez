

export default class {
    
    static async getAllNotes() {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                if (this.notes == undefined) {
                    this.notes = [
                        {
                            id: 1,
                            note: 'this is a note',
                            title: 'one',
                            user_id: 1,
                            created_at: '2018-08-15',
                            updated_at: '2018-08-20',
                            tags: [
                                {id: 1, text: 'Work'},
                                {id: 2, text: 'SQL'}
                            ]
                        },
                        {
                            id: 2,
                            note: 'this is another note',
                            title: 'two',
                            user_id: 1,
                            created_at: '2018-08-15',
                            updated_at: '2018-08-20',
                            tags: [
                                {id: 3, text: 'Golf'},
                                {id: 4, text: 'Skyrim'}
                            ]
                        }
                    ]
                }
                
                resolve(this.notes)
            }, 2000) 
        })
    }
    
    static async deleteNote(note) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                this.notes = this.notes.filter(n => n.id != note.id)
                console.log(this.notes)
                resolve(true)
            }, 2000)
        })
    }
    
    static async saveNote(note) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                this.notes.push(note)
                
                resolve(true)
            }, 2000)
        })
    }
    
}