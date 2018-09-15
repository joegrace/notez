

export default class {
    static getAllNotes() {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve([
                    {
                        note_text: 'this is a note',
                        user_id: 1,
                        created_at: '2018-08-15'
                    }    
                ])
            }, 2000) 
        });
    }
    
}