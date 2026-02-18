class cUtilesApis{
    
    async fetchHtml(link) {
        try {
            const res = await fetch(link);
            if (!res.ok) {
                throw new Error(`Error en la solicitud: ${res.status}`);
            }
            const data = await res.text();
            return data;

        } catch (error) {
            console.error('Error cargando la cuenta:', error);
            throw error;    
        }
    }        

    async fetchHtmlConParam(jsonvars, link) {
        try {
            let data 

            // Preparar los datos para la llamada
            const options = {
                method: "POST",
                body: JSON.stringify(jsonvars),
                headers: { "Content-Type": "application/json; charset=UTF-8" }
            };

            const res = await fetch(link, options);
            if (!res.ok) {
                throw new Error(`Error en la solicitud: ${res.status}`);
            }
            
            data = await res.text();
            return data;

        } catch (error) {
            console.error('Error cargando la cuenta:', error);
            throw error;    
        }
    }        

    async fetchSaveData(jsonvars, link){
        // Preparar los datos para la llamada
        const options = {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(jsonvars)
        };
            
        try{
            const res = await fetch(link, options);
            if (!res.ok) {
                throw new Error(`Error en la solicitud: ${res.status}`);
            }
            return true;
    
        } catch(error){
            console.error('Error al guardar los datos:', error);
            throw error;
        }
    }

    async fetchDataConParam(jsonvars, link){
        // Preparar los datos para la llamada
        const options = {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(jsonvars)
        };
            
        try{
            const res = await fetch(link, options);
            if (!res.ok) {
                throw new Error(`Error en la solicitud: ${res.status}`);
            }
            const data = await res.json();
            return data;
    
        } catch(error){
            console.error('Error al guardar los datos:', error);
            throw error;
        }
    }
    
    async fetchData(link){
        // Preparar los datos para la llamada
        const options = {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        };

        try{
            const res = await fetch(link, options);
            if (!res.ok) {
                throw new Error(`Error en la solicitud: ${res.status}`);
            }
            const data = await res.json();
            return data;
    
        } catch(error){
            console.error('Error al recuperar los datos de :' + link, error);
            throw error;
        }
    }    
}