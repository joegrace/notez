import Api from './Api'


export default class {
    
    static async getAllNotes() {
        let api = new Api('notes')
        
        return  await api.get()
    }
    
    static async deleteNote(note) {
        return new Promise(async (resolve, reject) => {
            let api = new Api('note')
            
            let result = await api.delete('/' + note.id)
            
            resolve(true);
        })
    }
    
    static async saveNote(note) {
        let api = new Api('note')
        
        return new Promise((resolve, reject) => {
            let result = api.post('/store', note)
            resolve(result)
        })
    }
    
}