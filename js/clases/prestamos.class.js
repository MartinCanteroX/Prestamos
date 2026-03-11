/*

*/
class cPrestamos{
    constructor(id){
        this._id = id;
    }

    /* set/get id
       -----------
    */
    set id(nuevoid){
        this._id = nuevoid;
    }
    
    get id(){
        return this._id;
    }
    
    //
    // Recuperar prestamos en formato HTML
    //
    async loadAllHtml(parametros){
        try{
            const link = BASE_URL + "prestamos/get/";
            
            const utilesApis = new cUtilesApis();
            const data = await utilesApis.fetchHtmlConParam(parametros, link);
            
            return data;

        }catch(error){
            avisoError("Prestamos - No se pueden recuperar !");
        }
    }

    //-------------------------------
    // Guardar datos de un prestamo
    //------------------------------
    async save(){
        try{
            const link = BASE_URL + "prestamos/save/";
                    
            const jsonvars = { 
                id : this._id
            };
   
            const utilesApis = new cUtilesApis();
            await utilesApis.fetchSaveData(jsonvars, link);
   
        } catch (error) {
            console.log("Error al guardar los datos del prestamo :", error);
            throw error;    
        }                   
    }
}

