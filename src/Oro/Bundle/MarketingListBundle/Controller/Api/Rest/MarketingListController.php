<?php

namespace Oro\Bundle\MarketingListBundle\Controller\Api\Rest;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Oro\Bundle\MarketingListBundle\Model\ContactInformationFieldHelper;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\RouteResource("marketinglist")
 * @Rest\NamePrefix("oro_api_")
 */
class MarketingListController extends RestController implements ClassResourceInterface
{
    /**
     * REST DELETE
     *
     * @param int $id
     *
     * @ApiDoc(
     *      description="Delete Marketing List",
     *      resource=true
     * )
     * @AclAncestor("oro_marketing_list_delete")
     *
     * @return Response
     */
    public function deleteAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * @Rest\Get(
     *      "/marketinglist/contact-information/field/type"
     * )
     * @ApiDoc(
     *     description="Get contact information field type by field name",
     *     resource=true
     * )
     * @param Request $request
     * @return Response
     */
    public function contactInformationFieldTypeAction(Request $request)
    {
        $entity = $request->get('entity');
        $field = $request->get('field');
        /** @var ContactInformationFieldHelper $helper */
        $helper = $this->get('oro_marketing_list.contact_information_field_helper');
        return $this->handleView(
            $this->view(
                $helper->getContactInformationFieldType($entity, $field),
                Codes::HTTP_OK
            )
        );
    }

    /**
     * @Rest\Get(
     *      "/marketinglist/contact-information/entity/fields"
     * )
     * @ApiDoc(
     *     description="Get entity contact information fields",
     *     resource=true
     * )
     * @param Request $request
     * @return Response
     */
    public function entityContactInformationFieldsAction(Request $request)
    {
        $entity = $request->get('entity');
        /** @var ContactInformationFieldHelper $helper */
        $helper = $this->get('oro_marketing_list.contact_information_field_helper');

        return $this->handleView($this->view($helper->getEntityContactInformationFieldsInfo($entity), Codes::HTTP_OK));
    }

    /**
     * {@inheritdoc}
     */
    public function getManager()
    {
        return $this->get('oro_marketing_list.marketing_list.manager.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        throw new \BadMethodCallException('Form is not available.');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        throw new \BadMethodCallException('FormHandler is not available.');
    }
}
