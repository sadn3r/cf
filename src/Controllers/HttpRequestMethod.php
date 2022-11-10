<?php

namespace CF\Controllers;

enum HttpRequestMethod: string {
	case GET = 'GET';
	case POST = 'POST';
	case DELETE = 'DELETE';
	case PUT = 'PUT';
	case OPTIONS = 'OPTIONS';
}
