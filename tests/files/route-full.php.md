# Images

* [ ] Users can view all images that have been uploaded
	* [ ] Images data table
		* [ ] Title
		* [ ] Description
	* [ ] Users can go to view details of existing image records
	* [ ] Users can delete existing image records
	* [ ] Users can create a new image record

	@get('images', ['uses' => 'Images@index', 'as' => 'images.index'])

* [ ] Users can create images
	* [ ] Form
		* [ ] Image Upload
			* [ ] Create thumbnail
		* [ ] Title
		* [ ] Description

	@get('images/new', ['uses' => 'Images@create', 'as' => 'images.create'])
	@post('images', ['uses' => 'Images@store', 'as' => 'images.store'])
