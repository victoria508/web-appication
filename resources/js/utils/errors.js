export default class Errors
{
    constructor()
    {
        this.errors = {};
        this.message = null;
    }

    any()
    {
        return this.errors.keys().length > 0;
    }

    has(field)
    {
        return this.errors.hasOwnProperty(field);
    }

    get(field)
    {
        if (this.errors[field])
        {
            return this.errors[field][0];
        }
    }

    clear(field)
    {
        delete this.errors[field];
    }

    clearAll()
    {
        this.errors = {};
    }

    record({message, errors})
    {
        this.errors = errors;
        this.message = message;
    }
}
