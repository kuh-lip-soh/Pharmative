@section('search')
<script>
    $(function () {
        $("#searchInput").keyup(function () {
            var searchTerm = $(this).val();
            if (searchTerm.length >= 2) {
                $.ajax({
                    url: "{{ route('article.search') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        search: searchTerm
                    },
                    success: function (data) {
                        $("#overlay").empty();

                        var proContainer = $("<div>").addClass("pro-container");
                        var section = $("<section>").addClass("recherche").attr("id", "product1");

                        $.each(data, function (index, article) {
                            var resultItem = $("<div>").addClass("pro");
                            var link = $("<a>").attr("href", "{{ route('article', [':id']) }}".replace(':id', article.id));
                            var image = $("<img>").attr("src", "{{ asset('images/') }}" + '/' + article.image).attr("alt", article.nom);

                            var des = $("<div>").addClass("des");
                            var nom = $("<span>").text(article.nom);
                            var utilisation = $("<h5>").text(article.utilisation);
                            var prix = $("<h4>").text(article.prix + " DA");
                            var form = $("<form>").attr("action", "{{ route('ajouter.panier', [':id']) }}".replace(':id', article.id)).attr("method", "POST");
                            var csrf = $("<input>").attr("type", "hidden").attr("name", "_token").val("{{ csrf_token() }}");
                            var button = $("<button>").attr("type", "submit").text("Ajouter au panier");

                            des.append(nom, utilisation, prix);
                            form.append(csrf, button);
                            link.append(image, des, form);
                            resultItem.append(link);
                            proContainer.append(resultItem);

                        });
                        section.append(proContainer);
                        $("#overlay").append(section);
                    }
                });
            }
        });
    });
</script>
