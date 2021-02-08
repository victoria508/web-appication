import axios from 'axios';
import Errors from './errors';

export default class Form
{
    constructor(data, axios = axios)
    {
        this.defaultData = data;
        this.data = Object.assign({}, data);

        this.errors = new Errors();
        this.axios = axios;
    }

    reset()
    {
        this.data = Object.assign({}, this.defaultData);
        this.errors.clearAll();
    }

    async submitThrough(request)
    {
        try
        {
            await request(this.data);

            this.reset();
        }
        catch (e)
        {
            this.errors.record(e.reponse.data);
        }
    }

    submit(method, url, rethrow = false)
    {
        return this.axios[method](url, this.data).then((response) =>
        {
            this.reset();

            return response;
        }).catch((error) =>
        {
            this.errors.record(error.response.data);

            if (rethrow)
            {
                throw error.response.data;
            }
        });
    }

    post(url, rethrow = false)
    {
        return this.submit('post', url, rethrow);
    }

    put(url, rethrow = false)
    {
        return this.submit('put', url, rethrow);
    }

    patch(url, rethrow = false)
    {
        return this.submit('patch', url, rethrow);
    }

    delete(url, rethrow = false)
    {
        return this.submit('delete', url, rethrow);
    }
}
