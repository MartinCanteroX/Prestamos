/*

*/
class cClientes{

        //
    // Recuperar vencimientos en formato HTML
    //
    async LoadAllHtml2( parametros ){
    
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

}