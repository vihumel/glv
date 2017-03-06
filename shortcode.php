<?php //Se diseña el formulario de suscripción 
    function form_suscription($atts){
        $form = '<div class="suscrption-container">
            <form class="suscription">
                <div class="input-group">
                   <label><i class="fa fa-user"></i> Nombre:</label>
                   <input id="name" name="Nombre" type="text" placeholder="Nombre" class="form-control required">
                </div><div class="input-group">
                   <label><i class="fa fa-envelope"></i> Correo:</label> 
                   <input id="email" name="Correo" type="email" placeholder="Correo" class="form-control required">
                </div><div class="input-group">
                   <button class="btn-galvan" data-form="suscription" data-action="glv_form_save"><i class="fa fa-send"></i> Suscribir</button>
                </div>

                <div class="frm-group">
                    <input type="hidden" name="Fuente" id="site" value="'.home_url(add_query_arg(array())).'">
                    <input type="hidden" name="type" value="suscripcion">
                </div>
            </form>
            <div class="status-form"></div>
        </div>';

      return $form;
   }
   add_shortcode('form_suscription', 'form_suscription');

   function form_mkt($atts){
    $form = '<div class="suscription-container">
      <form class="mkt contact">
        <div class="col-xs-12 no-padding-left">
          <div class="input-group">
            <label><i class="fa fa-user"></i> Nombre*</label>
            <input type="text" name="Nombre" class="form-control required" placeholder="Nombre Completo">
          </div>
          <div class="input-group">
            <label><i class="fa fa-building"></i> Empresa</label>
            <input type="text" name="Empresa" class="form-control" placeholder="Nombre de su Empresa">
          </div>
          <div class="input-group">
            <label><i class="fa fa-phone"></i> Teléfono:*</label>
            <input type="text" name="Telefono" class="form-control numbers required" placeholder="+?? (???) ??? ????">
          </div>
          <div class="input-group">
            <label><i class="fa fa-envelope"></i> Correo Electrónico:*</label>
            <input type="email" name="Correo" id="email" class="form-control required" placeholder="correo@email.com">
          </div>
          <div class="input-group">
            <label><i class="fa fa-cogs"></i> Servicio requerido*</label>
            <select name="Servicio[]" class="form-control select2_multiple required" multiple="multiple">
              <option value="">Seleccione un Servicio</option>
              <optgroup label="Despacho Aduana">
                <option>Aéreo</option>
                <option>Marítimo</option>
                <option>Terrestre</option>
                <option>Operaciones Especiales</option>
              </optgroup>
              <optgroup label="Servicios">
                <option>Asesoría</option>
                <option>Auditoria</option>
                <option>Bolsa de Trabajo</option>
              </optgroup>
              <option>Otros</option>
            </select>
          </div>
          <div class="input-group">
            <label><i class="fa fa-comments-o"></i> Comentarios:</label>
            <textarea name="comentarios" class="form-control" placeholder="Dejanos tus comentarios"></textarea>
          </div>
          <div class="input-group">
            <button class="btn-galvan" data-form="contact" data-action="glv_form_save"><i class="fa fa-send"></i> Enviar</button>
          </div>
          </div>
        <div class="frm-group">
            <input type="hidden" name="Fuente" id="site" value="'.home_url(add_query_arg(array())).'">
            <input type="hidden" name="type" value="contacto">
        </div>
      </form>
      <div class="status-form"></div>
      </div>
    ';
    return $form;
   }
   add_shortcode('form_mkt', 'form_mkt');
  

  function form_contact($atts){
    $form = '<div class="suscription-container">
      <form class="mkt contact">
        <div class="col-xs-12 no-padding-left">
          <div class="input-group">
            <label><i class="fa fa-user"></i> Nombre*</label>
            <input type="text" name="Nombre" class="form-control required" placeholder="Nombre Completo">
          </div>
          <div class="input-group">
            <label><i class="fa fa-building"></i> Empresa</label>
            <input type="text" name="Empresa" class="form-control" placeholder="Nombre de su Empresa">
          </div>
          <div class="input-group">
            <label><i class="fa fa-phone"></i> Teléfono:*</label>
            <input type="text" name="Telefono" class="form-control numbers required" placeholder="+?? (???) ??? ????">
          </div>
          <div class="input-group">
            <label><i class="fa fa-envelope"></i> Correo Electrónico:*</label>
            <input type="email" name="Correo" id="email" class="form-control required" placeholder="correo@email.com">
          </div>

          <div class="input-group">
            <div class="col-xs-12">
                <label><i class="fa fa-cogs"></i> Servicio requerido*</label>
            </div>
            <div class="col-sm-6 col-xs-12">
                <p><h5>Despacho Aduanal</h5></p>
                <p><input type="checkbox" name="Servicio[]" value="Áereo"> Áereo</p>
                <p><input type="checkbox" name="Servicio[]" value="Marítimo"> Marítimo</p>
                <p><input type="checkbox" name="Servicio[]" value="Terrestre"> Terrestre</p>
                <p><input type="checkbox" name="Servicio[]" value="Operaciones Especiales"> Operaciones Especiales</p>
            </div>
            <div class="col-sm-6 col-xs-12">
                <p><h5>Servicios</h5></p>
                <p><input type="checkbox" name="Servicio[]" value="Asesoría"> Asesoría</p>
                <p><input type="checkbox" name="Servicio[]" value="Capacitación"> Capacitación</p>
                <p><input type="checkbox" name="Servicio[]" value="Ausditoria"> Ausditoria</p>
                <p><input type="checkbox" name="Servicio[]" value="Bolsa de Trabajo"> Bolsa de Trabajo</p>
            </div>
          </div>
          <div class="input-group">
            <label><i class="fa fa-comments-o"></i> Comentarios:</label>
            <textarea name="comentarios" class="form-control" placeholder="Dejanos tus comentarios"></textarea>
          </div>
          <div class="input-group">
            <button class="btn-galvan" data-form="contact" data-action="glv_form_save"><i class="fa fa-send"></i> Enviar</button>
          </div>
        </div>
        <div class="frm-group">
            <input type="hidden" name="Fuente" id="site" value="'.home_url(add_query_arg(array())).'">
            <input type="hidden" name="type" value="contacto">
        </div>
      </form>
      <div class="status-form"></div>
      </div>
    ';
    return $form;
   }
   add_shortcode('form_contact', 'form_contact');
?>