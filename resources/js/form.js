import axios from "axios";

class Errors {
    constructor() {
        this.errors = {};
    }

    get(field) {
        if (this.errors[field]) {
            console.log(field);
            console.log(this.errors[field]);
            return this.errors[field][0];
        }
    }

    record(errors) {
        this.errors = errors;
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    any() {
        for (let i in this.errors) {
            return true;
        }
        return false;
    }

    clear(field) {
        if (field) {
            if (this.errors[field]) {
                delete this.errors[field];
                return;

                // If you're not using a preprocessor you'll have problem with this part, it will be not reactive.
                // Use Vue.delete(this.errors, field);
            }
        } else this.errors = {};
    }
}

export class Form {
    constructor(data) {
        this.originalData = data;

        Object.keys(data).forEach((field) => {
            this[field] = data[field];
        });
        this.errors = new Errors();
    }

    data() {
        if (this.anyIsFile()) {
            const formData = new FormData();
            Object.keys(this.originalData).forEach(
                field => formData.append(field.toString(), this[field])
            );
            formData.append('_method', 'PUT')
            return formData;
        }
        return Object.keys(this.originalData).reduce(
            (acc, field) => {
                acc[field] = this[field];
                return acc;
            },
            {}
        );
    }

    anyIsFile() {
        return Object.keys(this.originalData).some(
            field => this[field] instanceof File
        );
    }

    reset() {
        Object.keys(this.originalData).forEach((field) => {
            this[field] = "";
        });
        this.errors.clear();
    }

    async submit(requestType, url) {
        try {
            // Handle multipart/form-data in php
            // known bug: https://bugs.php.net/bug.php?id=55815
            let request = requestType;
            let data = this.data();
            const config = {};

            if (this.anyIsFile()) {
                config.headers = {'Content-Type': 'multipart/form-data'};
                request = 'post';
                data.append('_method', requestType.toUpperCase());
            }

            const response = await axios[request](url, data, config);
            this.onSuccess(response.data);
            return response.data;

        } catch (error) {
            this.onFail(error);
        }
    }

    onSuccess() {
       // Do something
    }

    onFail(errors) {
        if (errors?.response)
            this.errors.record(errors.response.data.errors);
    }
}
