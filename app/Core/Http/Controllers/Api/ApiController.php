<?php namespace TGL\Core\Http\Controllers\Api;

use TGL\Src\Fractal\Manager;
use TGL\Src\Fractal\Pagination\IlluminatePaginatorAdapter;
use TGL\Src\Fractal\Resource\Collection;
use TGL\Src\Fractal\Resource\Item;
use TGL\Core\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @var Manager
     */
    protected $fractal;

    const CODE_WRONG_ARGS = 'GEN-FUBARGS';
    const CODE_NOT_FOUND = 'GEN-LIKETHEWIND';
    const CODE_INTERNAL_ERROR = 'GEN-AAAGGH';
    const CODE_UNAUTHORIZED = 'GEN-MAYBGTFO';
    const CODE_FORBIDDEN = 'GEN-GTFO';

    /**
     * @param Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * Getter for statusCode
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
         $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $collection
     * @param $callback
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * @param $item
     * @param $callback
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function respondWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    protected function respondWithPaginator($collection, $callback, $paginator)
    {
        $resource = new Collection($collection, $callback);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * @param array $array
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        $response = response()->json($array, $this->statusCode, $headers);
        // $response->header('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @param $message
     * @param $errorCode
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
                E_USER_WARNING
            );
        }
        return $this->respondWithArray([
            'error' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }
    /**
     * Generates a Response with a 403 HTTP header and a given message.
     *
     * @return  Response
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message, self::CODE_FORBIDDEN);
    }
    /**
     * Generates a Response with a 500 HTTP header and a given message.
     *
     * @return  Response
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    /**
     * Generates a Response with a 404 HTTP header and a given message.
     *
     * @return  Response
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message, self::CODE_NOT_FOUND);
    }
    /**
     * Generates a Response with a 401 HTTP header and a given message.
     *
     * @return  Response
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)->respondWithError($message, self::CODE_UNAUTHORIZED);
    }
    /**
     * Generates a Response with a 400 HTTP header and a given message.
     *
     * @return  Response
     */
    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)->respondWithError($message, self::CODE_WRONG_ARGS);
    }
}
