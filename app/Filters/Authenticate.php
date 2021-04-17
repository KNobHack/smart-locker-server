<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Authenticate implements FilterInterface
{
	/**
	 * Authenticating user based on session
	 *
	 * @param RequestInterface $request
	 * @param array|null       $arguments
	 *
	 * @return mixed
	 */
	public function before(RequestInterface $request, $arguments = null)
	{
		if (session('username') === null) {
			return json_encode(['status' => 'Unauthorized', 'code' => 401, 'message' => 'Loged out']);
		}
	}

	/**
	 * Allows After filters to inspect and modify the response
	 * object as needed. This method does not allow any way
	 * to stop execution of other after filters, short of
	 * throwing an Exception or Error.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param array|null        $arguments
	 *
	 * @return mixed
	 */
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		if (session('username') === null) {
			$response->setStatusCode(401);
		}
	}
}
