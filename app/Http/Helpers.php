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


// GET AVATAR
function getAvatar( $size, $image_name ) {
	if ( $size === 'big' ) {
		if ( file_exists( public_path() . '/uploads/avatars/b_thumb/' . $image_name ) ) {
			return '/uploads/avatars/b_thumb/' . $image_name;
		} else {
			return '/images/default/default_b_thumb.png';
		}
	}
	if ( $size === 'normal' ) {
		if ( file_exists( public_path() . '/uploads/avatars/n_thumb/' . $image_name ) ) {
			return '/uploads/avatars/n_thumb/' . $image_name;
		} else {
			return '/images/default/default_n_thumb.png';
		}
	}
	if ( $size === 'micro' ) {
		if ( file_exists( public_path() . '/uploads/avatars/m_thumb/' . $image_name ) ) {
			return '/uploads/avatars/m_thumb/' . $image_name;
		} else {
			return '/images/default/default_m_thumb.png';
		}
	}
	return 'Такого размера изображения не существует!';
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
function getOnlineTime( $gender_int, $time ) {
	if ( $gender_int == 2 ) {
		return 'заходил ' . $time;
	} elseif ( $gender_int == 1 ) {
		return 'заходила ' . $time;
	}
	return $time;
}