<?php

namespace RestApi\Response;

use Symfony\Component\HttpFoundation\Response;

class ValidResponse extends AbstractHttpResponse
{
    private $data = [];

    /**
     * @param string $message
     *
     * @return Response|static
     */
    public function respondSuccess($message = '')
    {
        return $this->setStatusCode(Response::HTTP_OK)->respondWithSuccess($message);
    }

    /**
     * @param string $message
     *
     * @return Response|static
     */
    public function respondCreated($message = '')
    {
        return $this->setStatusCode(Response::HTTP_CREATED)->respondWithSuccess($message);
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
    /**
     * @param $messageDetail
     *
     * @return Response|static
     */
    private function respondWithSuccess($messageDetail)
    {
        $message = $this->buildValidMessage(
            Response::$statusTexts[$this->getStatusCode()],
            $messageDetail
        );

        return $this->outputToJson($message);
    }

    /**
     * @param string $title
     * @param string $detail
     *
     * @return array
     */
    private function buildValidMessage($title, $detail)
    {
        return [
            'result' => 'success',
            'details' => [
                'title' => $title,
                'message' => $detail,
                'data' => $this->data
            ]
        ];
    }

}
