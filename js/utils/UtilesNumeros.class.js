class cUtilesNumeros{
  
  /* 
    Devolver el numero formateado y con el simbolo de la moneda
    indicado
    Parametros : currency = simbolo de la moneda
                 value = importe
  */
   numberFormatter( value ) {
    const formatter = new Intl.NumberFormat('es-ES', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }) 
    return formatter.format(value)
  }
}