`<div class="col-lg-3 col-md-4 col-xs-6 thumb item" id="remove_`+ imageData.id +`">
    <a class="thumbnail" href="` + imageData.image_url + `"  data-lightbox="photos" >
        <img class="img-thumbnail"
             src="` + imageData.image_url + `"
             alt="Another alt text">
    </a>
    <p>` + imageData.image_title + `</p>
    <button class="btn btn-danger text-center" onclick="removeImage(`+imageData.id+`)"><i class="fa fa-trash"> </i> Remove </button>
</div>`
