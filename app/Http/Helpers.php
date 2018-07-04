<?php
// MENU ACTIVE ELEMENT
function is_active( $routeNames ) {
	$routeNames = (array) $routeNames;
	foreach ( $routeNames as $routeName ) {
		if ( Route::is( $routeName ) ) {
			return ' active';
		}
	}
	return '';
}


//GET IMAGE PATH
function getImage( $size, $image_name ) {
	if ( $size === 'original' ) {
		if ( file_exists( public_path() . '/uploads/images/originals/' . $image_name ) ) {
			return '/uploads/images/originals/' . $image_name;
		} else {
			return '/images/default/default_original.png';
		}
	}
	if ( $size === 'cover' ) {
		if ( file_exists( public_path() . '/uploads/images/covers/' . $image_name ) ) {
			return '/uploads/images/covers/' . $image_name;
		} else {
			return '/images/default/default_cover.png';
		}
	}
	if ( $size === 'normal' ) {
		if ( file_exists( public_path() . '/uploads/images/normals/' . $image_name ) ) {
			return '/uploads/images/normals/' . $image_name;
		} else {
			return '/images/default/default_normal.png';
		}
	}
	if ( $size === 'thumbnail' ) {
		if ( file_exists( public_path() . '/uploads/images/thumbnails/' . $image_name ) ) {
			return '/uploads/images/thumbnails/' . $image_name;
		} else {
			return '/images/default/default_user.png';
		}
	}
	if ( $size === 'news' ) {
		if ( file_exists( public_path() . '/uploads/images/news/' . $image_name ) ) {
			return '/uploads/images/news/' . $image_name;
		} else {
			return '/images/default/default_user.png';
		}
	}
	return 'Такого размера изображения не существует!';
}


// GET SEX
function getSex( $sex_int ) {
	if ( $sex_int == 1 ) {
		return 'Мужской';
	} else if ( $sex_int == 2 ) {
		return 'Женский';
	}
	return 'Ошибка! Пол не определен!';
}


// GET ONLINE ON SEX
function getOnlineTime( $sex_int, $time ) {
	if ( $sex_int == 1 ) {
		return 'заходил ' . $time;
	} elseif ( $sex_int == 2 ) {
		return 'заходила ' . $time;
	}
	return $time;
}