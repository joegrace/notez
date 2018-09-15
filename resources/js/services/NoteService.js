

export default class {
    static async getAllNotes() {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve([
                    {
                        note: 'this is a note',
                        title: 'one',
                        user_id: 1,
                        created_at: '2018-08-15'
                    },
                    {
                        note: 'this is another note',
                        title: 'two',
                        user_id: 1,
                        created_at: '2018-08-15'
                    }
                ])
            }, 2000) 
        })
    }
    
    static deleteNote(note) {
        
    }
    
}