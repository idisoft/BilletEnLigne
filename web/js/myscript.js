$(function(){               
    //Gestion de l'autocompletition du champs materiel
    
    $('input[data-id="materiel"]').autocomplete({  //utilisee au niveau de l'enregistement d'un depannage
        source: function (request, response)
        {          
            //Requete Ajax
            var url = $(this.element).attr('data-url');
            objData = {materiel : request.term};
            $.ajax({
                    url: url,
                    dataType: "json",
                    data : objData,
                    type: 'POST',
                    success: function (donnees)
                    {
                        
                        response($.map(donnees, function (item)
                        {
                            return {
                                        value: function ()
                                        {
                                            return item.materiel;                                           
                                        }
                                    };
                        }));
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log(textStatus, errorThrown);
                    }
            });
        },
            minLength: 3,
            delay: 300
	});
        
        
//  ----------------------------------------- datapicker -----------------------
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy"
    }); 
    
//    -------------------------------------- sidebar ---------------------------
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    
});