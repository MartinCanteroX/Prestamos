/*
    Login
*/
class cLogin{
   constructor( Id ){
    this._id = Id;
    this._nombre = "";
    this._clave = "";
   }

   // set/get id
   // -----------
   set id(nuevoid){;
    this._id = nuevoid;
   }
   
   get id(){
    return this._id;
   }
   
   // set/get nombre
   // -----------
   set nombre(nuevonombre){;
    this._nombre = nuevonombre;
   }
   
   get nombre(){
    return this._nombre;
   }

   /* set/get clave
      -----------
   */
   set clave(nuevoclave){;
    this._clave = nuevoclave;
   }
   
   get clave(){
    return this._clave;
   }

   //------------------------------
   // Cargar un login
   //------------------------------
   async load( id, nombre){

        // si no se indica nombre y clave, toma las guardados
        if ( ! id ){
            id = this._id;
        }
        if ( ! nombre){
            nombre = this._nombre;
        }

        // Link para validar
        
        // parametros
        let jsonvars = { 
            nombre : nombre,
            id : id
        };
        
        try{
            const link = BASE_URL + "login/get/";
            const utilesApis = new cUtilesApis();
            const data = await utilesApis.fetchDataConParam( jsonvars, link );

            // Completar los datos del usuario
            if (data){
                this.id = data.id;
                this.clave = data.clave;
                this.nombre = data.nombre;
            }
                
        }catch(error){
            throw error + "(Login.Validar)";
        }
   }

   //------------------------------
   //   Verificar el usuario y la clava
   //------------------------------
   async validar( nombre, clave){

        try{
            // si no se indica nombre y clave, toma las guardados
            if ( ! nombre){
                nombre = this.nombre;
            }
            if ( ! clave){
                clave = this.clave;
            }
            if ( ! nombre || ! clave){
                return false;
            }

            // Cargar el login
            await this.load( 0, nombre);

            // Validar el nombre y la clave
            const ok = ( this.id > 0 && clave == this.clave  );
            return ok;

        }catch(error){
            throw error + "(Login.Validar)";
        }
   }

   //------------------------------
   // Marcar como activo el actual usuario
   //------------------------------
   async setCurrent(){

        if ( ! this.id){
            return false;
        }

        try{
            const link = BASE_URL + "login/setCurrent/" + this.id;
            const utilesApis = new cUtilesApis();
            const data = await utilesApis.fetchData( link );

        }catch(error){
            throw error + "(Login.Validar)";
        }
   }
}