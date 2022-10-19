/*tab reserv*/
$(document).ready(function() {
	$("#reserv").dataTable().fnDestroy();
    $('#reserv').DataTable( {
	"order": [[ 4, "asc" ]],
	"language": {
    "emptyTable":     "Aucune réservation enregistrée",
    "info":           "Affichage de _START_ à _END_ des _TOTAL_ réservations",
    "infoEmpty":      "Affichage de 0 à 0 des 0 réservations",
    "infoFiltered":   "(Recherché parmi les _MAX_ réservations)",
    "lengthMenu":     "Affichage _MENU_ réservations",
	"search":         "Rechercher :",
    "zeroRecords":    "Aucune correspondance trouvée",
    "paginate": {
        "next":       "Suivant",
        "previous":   "Précedent"
	}
    },
        initComplete: function () {
            this.api().column(2).every( function () {
                var column = this;
                var select = $('<select style="width: 100%"><option value="">Formations</option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

/*tab reservAnt*/
$(document).ready(function() {
	$("#reservAnt").dataTable().fnDestroy();
    $('#reservAnt').DataTable( {
	 "order": [[ 4, "desc" ]],
	  "language": {
    "emptyTable":     "Aucune réservation enregistrée",
    "info":           "Affichage de _START_ à _END_ des _TOTAL_ réservations",
    "infoEmpty":      "Affichage de 0 à 0 des 0 réservations",
    "infoFiltered":   "(Recherché parmi les _MAX_ réservations)",
    "lengthMenu":     "Affichage _MENU_ réservations",
	"search":         "Rechercher :",
    "zeroRecords":    "Aucune correspondance trouvée",
    "paginate": {
        "next":       "Suivant",
        "previous":   "Précedent"
	}
    },
        initComplete: function () {
            this.api().column(2).every( function () {
                var column = this;
                var select = $('<select style="width: 100%"><option value="">Formations</option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

/*tab MS*/
$(document).ready(function() {
	$("#ministage").dataTable().fnDestroy();
    $('#ministage').DataTable( {
	 "order": [[ 2, "asc" ]],
	  "language": {
    "emptyTable":     "Aucun mini-stage enregistré",
    "info":           "Affichage de _START_ à _END_ des _TOTAL_ mini-stages",
    "infoEmpty":      "Affichage de 0 à 0 des 0 mini-stages",
    "infoFiltered":   "(Recherché parmi les _MAX_ mini-stages)",
    "lengthMenu":     "Affichage _MENU_ mini-stages",
	"search":         "Rechercher :",
    "zeroRecords":    "Aucune correspondance trouvée",
    "paginate": {
        "next":       "Suivant",
        "previous":   "Précedent"
	}
    },
        initComplete: function () {
            this.api().column(0).every( function () {
                var column = this;
                var select = $('<select style="width: 100%"><option value="">Formations</option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} ); 

/*tab MSAnt*/
$(document).ready(function() {
	$("#ministageAnt").dataTable().fnDestroy();
    $('#ministageAnt').DataTable( {
	 "order": [[ 2, "desc" ]],
	  "language": {
    "emptyTable":     "Aucun mini-stage enregistré",
    "info":           "Affichage de _START_ à _END_ des _TOTAL_ mini-stages",
    "infoEmpty":      "Affichage de 0 à 0 des 0 mini-stages",
    "infoFiltered":   "(Recherché parmi les _MAX_ mini-stages)",
    "lengthMenu":     "Affichage _MENU_ mini-stages",
	"search":         "Rechercher :",
    "zeroRecords":    "Aucune correspondance trouvée",
    "paginate": {
        "next":       "Suivant",
        "previous":   "Précedent"
	}
    },
        initComplete: function () {
            this.api().column(0).every( function () {
                var column = this;
                var select = $('<select style="width: 100%"><option value="">Formations</option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} ); 

/*tab Util*/
$(document).ready(function() {
	$("#utilisateur").dataTable().fnDestroy();
    $('#utilisateur').DataTable( {
	 "order": [[ 0, "asc" ]],
	  "language": {
    "emptyTable":     "Aucun utilisateur enregistré",
    "info":           "Affichage de _START_ à _END_ des _TOTAL_ utilisateurs",
    "infoEmpty":      "Affichage de 0 à 0 des 0 utilisateurs",
    "infoFiltered":   "(Recherché parmi les _MAX_ utilisateurs)",
    "lengthMenu":     "Affichage _MENU_ utilisateurs",
	"search":         "Rechercher :",
    "zeroRecords":    "Aucune correspondance trouvée",
    "paginate": {
        "next":       "Suivant",
        "previous":   "Précedent"
	}
    },
        initComplete: function () {
            this.api().column(3).every( function () {
                var column = this;
                var select = $('<select><option value="">Profil</option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} ); 

/*tab Form*/
$(document).ready(function() {
	$("#formation").dataTable().fnDestroy();
    $('#formation').DataTable( {
	 "order": [[ 0, "asc" ]],
	  "language": {
    "emptyTable":     "Aucune formation enregistré",
    "info":           "Affichage de _START_ à _END_ des _TOTAL_ formations",
    "infoEmpty":      "Affichage de 0 à 0 des 0 formations",
    "infoFiltered":   "(Recherché parmi les _MAX_ formations)",
    "lengthMenu":     "Affichage _MENU_ formations",
	"search":         "Rechercher :",
    "zeroRecords":    "Aucune correspondance trouvée",
    "paginate": {
        "next":       "Suivant",
        "previous":   "Précedent"
	}
    },
        initComplete: function () {
            this.api().column(0).every( function () {
                var column = this;
                var select = $('<select><option value="">Type</option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} ); 