import Api from './Api'


export default class {
    
    static async getAllNotes() {
        let api = new Api('notes')
        
        return  await api.get()
    }
    
    static async deleteNote(note) {
        let api = new Api('note')
        
        let result = await api.delete('/' + note.id)      
        
        return result
    }
    
    static async saveNote(note) {
        let api = new Api('note')
        
        let result = api.post('/store', note)

        return result
    }

    static async exportNotes() {
        let notes = await this.getAllNotes()
        
        // Now lets send the notes as a file download
        const url = window.URL.createObjectURL(new Blob([JSON.stringify(notes)]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'notezExport.json');
        document.body.appendChild(link);
        link.click();
    }
    
}