$(document).ready(function(){
        $(document).on('click','.view_detaiile_retard', function(){
            var Id_Retard  = $(this).attr("data-id");
            //alert(Id_Retard);
        if(Id_Retard != 0)
       {
        $.ajax({
                     url: "{{ route('Retard.Modal') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Id_Retard:Id_Retard}, beforeSend:function(){
                 },
                     success: function(response){
                        //toastr.success("Bien Recherche");
                        $('.modal-body').html(response); 
                        $('#Modal_Retard_Detaille').modal('show'); 
                     }
                 });
        }
        });
        /*Select 2*/
        $('#Departement').select2();
        $('#Departement_employee').select2();
        $('#Id_Employee').select2();
        $('#Motif').select2();
        /*Fin select 2*/
        /*Datatable*/
        
        /*Fin datatable*/
        
        
        $(document).on('click','#Delete', function(e){
        e.preventDefault();
        var link = $(this).attr('href');
            Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
       if (result.isConfirmed) {
       window.location.href = link;
       Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success')}})
        });
        


      /*$("#Notification").click(function(){
        $.ajax({
                     url: '/User/Notification',
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}"}, 
                      beforeSend:function(){
                    },
                     success: function(response){
                        $('#Notification_Count').remove();
                     }
        });
      });*/
      //Filter employee
      $('#Employe').select2();
      $('#Employe_1').select2();
      $('#Employe_2').select2();
      $(document).on('change','#Employe', function(){
       var Filter_1  = $("#Employe").val();
       //alert(Filter_1);
       if(Filter_1 != '')
       {
        $.ajax({
                     url: "{{ route('Employee.Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success("Bien Recherche");
                         $(".Departement_Div").html(response);
                     }
                 });
        }
      });
      //Filter Departement
      $(document).on('change','#Departement', function(){
       var Filter_1  = $("#Departement").val();
       //alert(Filter_1);
       if(Filter_1 != '')
       {
        $.ajax({
                     url: "{{ route('Departement.Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success("Bien Recherche");
                         $(".Departement_Div").html(response);
                     }
                 });
        }
      });
      /*$(document).on('change','#user_type', function(){
       var Filter_1  = $("#user_type").val();
       if(Filter_1 != '')
       {
        $.ajax({
                     url: '/User/Filter',
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success("Bien Recherche");
                         $(".div_1").html(response);
                     }
                 });
        }
      });*/
      $(document).on('click','#Cherche_Pointage', function(){
       var Filter_1  = $("#Employe_1").val();
       var Filter_3  = $("#Range_1").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
       if(Filter_1 != '')
       {
        $.ajax({
                     url: "{{ route('Pointage_Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success("Bien Recherche");
                         $(".Pointage_Div").html(response);
                     }
                 });
        }
      });
      /*Retard filter*/
      $(document).on('click','#Cherche_Retard', function(){
       var Filter_1  = $("#Employe_1").val();
       var Filter_3  = $("#Range_1").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
       if(Filter_1 != '')
       {
        $.ajax({
                     url: "{{ route('Retard_Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin}, beforeSend:function(){
                 },
                     success: function(response){
                         toastr.success("Bien Recherche");
                         $(".Retard_Div").html(response);
                     }
                 });
        }
      });
      /*Fin retard filter*/
      /*Filter factures*/
      $('#Status').select2();
      $('#N_Facture').select2();
      $(document).on('click','#Cherche_Facture', function(){
       var Filter_1  = $("#Status").val();
       var Filter_2  = $("#N_Facture").val();
       var Filter_3  = $("#Range_1").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
       if(Filter_1 != '')
       {
        $.ajax({
                     url: "{{ route('Facture_Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin,Filter_2:Filter_2}, beforeSend:function(){
                 },
                     success: function(response){
                         toastr.success("Bien Recherche");
                         $(".factures_Div").html(response);
                     }
                 });
        }
      });
      /*Fin filter factures*/
      /**/
      $('#Type').select2();
      $(document).on('change','#Type', function(){
       var Filter_1  = $("#Type").val();
       //alert(Filter_1);
       if(Filter_1 == 'Client')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label">Client</label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Type_1" name="nom_complet"><option value="Client 1">Client 1 </option><option value="Client 2">Client 2</option><option value="Client 3">Client 3</option><option value="Client 4">Client 4</option></select></div>');
       if(Filter_1 == 'Fourniseur')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label">Fourniseur</label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Type_1"  name="nom_complet"><option value="Fourniseur 1">Fourniseur 1 </option><option value="Fourniseur 2">Fourniseur 2</option><option value="Fourniseur 3">Fourniseur 3</option><option value="Fourniseur 4">Fourniseur 4</option></select></div>');
       if(Filter_1 == 'Personne_physique')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label">Personne physique</label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Type_1"  name="nom_complet"><option value="Personne physique 1">Personne physique 1 </option><option value="Personne physique 2">Personne physique 2</option><option value="Personne physique 3">Personne physique 3</option><option value="Personne physique 4">Personne physique 4</option></select></div>');
       else
       if(Filter_1 == '0')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label"></label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Type_1"  name="nom_complet"></select></div>');
       $('#Type_1').select2();
       /*if(Filter_1 != '')
       {
        $.ajax({
                     url: "{{ route('Facture_Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin,Filter_2:Filter_2}, beforeSend:function(){
                 },
                     success: function(response){
                         toastr.success("Bien Recherche");
                         $(".factures_Div").html(response);
                     }
                 });
        }*/
      });
      
      /**/
      /*Rangebicker*/
      var start =moment().subtract(100,'year');
      var end = moment().add(100,'year');
      function cb(start, end) {$('#Range_1 span').html('Achraf');}//start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
      $('#Range_1').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            applyLabel: 'Appliquer',
            customRangeLabel: 'Personnalisée',
        },
        
        startDate: start,
        endDate: end,
        ranges: {
           'Aujourd_hui': [moment(), moment()],
           'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
           'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
           'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')],
           'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
       }, cb);
      //cb(start, end);
    /*Fin rangebicker*/
    //
    $("#Avertisement_div").hide();
    $("#Avertisement").change(function() {
    if(this.checked) {
        $("#Avertisement_div").toggle(700);
    }else{
        $("#Avertisement_div").toggle(700);;
    }
    });
     
    //
      
    });