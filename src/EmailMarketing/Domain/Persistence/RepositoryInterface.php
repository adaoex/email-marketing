<?php

namespace EmailMarketing\Domain\Persistence;

interface RepositoryInterface
{

    public function create($entity);

    public function update($entity);

    public function remove($entity);

    public function find($id);

    public function findAll();
}
