/*

*/
class cClientes{
    constructor(id){
        this._nombre = "";
        this._id = id;
    }

    /* set/get nombre
       -----------
    */
    set nombre(nuevonombre){;
        this._nombre = nuevonombre;
    }
    
    get nombre(){
        return this._nombre;
    }

    /* set/get nombre
       -----------
    */
    set id(nuevoid){;
        this._id = nuevoid;
    }
    
    get nombre(){
        return this._id;
    }
    
    
    //
    // Recuperar clientes en formato HTML
    //
    async LoadAllHtml( parametros ){
    
        try{

            const link = BASE_URL + "clientes/get/";
            
            // Recuperar los datos
            let utilesApis = new cUtilesApis();
            const data = await utilesApis.fetchHtmlConParam(parametros, link);
            
            return data;

        }catch(error){
            avisoError( "Vencimientos - No se los puede recuperar por Fecha  !");    
        }
    }

   //-------------------------------
    // Actualizar los datos de un vencimiento
    //------------------------------
    async save(){
        try{
   
            // Preparar parametros
            const link = BASE_URL + 'clientes/save/';
                    
            let jsonvars = { 
                    id : this._id, 
                    nombre : this._nombre,
                };
   
            const utilesApis = new cUtilesApis();
            await utilesApis.fetchSaveData( jsonvars, link );
   
        } catch (error) {
            console.log('Error al guardar los datos del clase :', error);
            throw error;    
        }                   
    }

}