<?php

namespace Lw\Infrastructure\Persistence\Doctrine\Wish;

use Doctrine\ORM\EntityRepository;
use Lw\Domain\Model\User\UserId;
use Lw\Domain\Model\Wish\Wish;
use Lw\Domain\Model\Wish\WishId;
use Lw\Domain\Model\Wish\WishRepository;

class DoctrineWishEmailRepository extends EntityRepository implements WishRepository
{
    /**
     * @param WishId $wishId
     * @return Wish
     */
    public function wishOfId(WishId $wishId)
    {
        return $this->find($wishId->id());
    }

    /**
     * @param UserId $userId
     * @return Wish[]
     */
    public function wishesOfUserId(UserId $userId)
    {
        return $this->findBy(['surrogateUserId' => $userId->id()]);
    }

    /**
     * @param Wish $wish
     * @return mixed
     */
    public function persist(Wish $wish)
    {
        $this->getEntityManager()->persist($wish);
        $this->getEntityManager()->flush($wish);
    }

    /**
     * @param Wish $wish
     */
    public function remove(Wish $wish)
    {
        $this->getEntityManager()->remove($wish);
        $this->getEntityManager()->flush($wish);
    }

    /**
     * @return WishId
     */
    public function nextIdentity()
    {
        return new WishId();
    }
}
