import axios from 'axios'

export default class {
    
    constructor(endpointPrefix) {
        // Everything is in /api/
        this._prefix = '/api/' + endpointPrefix
    }
    
    async get(endpoint) {
        if (endpoint == undefined)
            endpoint = ''
        
        let result;
        try {
            result = await axios.get(this._prefix + endpoint)
        }
        catch (e) {
            console.log('Something happened on post: ' + e)
        }
        
        return result.data;
    }
    
    async post(endpoint, data) {
        let result;
        
        try {
            result = await axios.post(this._prefix + endpoint, data)
        }
        catch (e) {
            console.log('Something happened on post: ' + e)
        }
        
        return result.data;
    }
    
    async delete(endpoint, data) {
        let result;
        
        try {
            result = await axios.delete(this._prefix + endpoint, data)
        }
        catch (e) {
            console.log('Something happened on delete: ' + e)
        }
        
        return result.data;
    }
    
}