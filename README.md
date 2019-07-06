# Eris - property based testing

Don't write tests. Generate them! - John Hughes

## What is this?
Eris is a PHP port of Haskell's QuickCheck

See this [blog](https://blog.jessitron.com/2013/04/25/property-based-testing-what-is-it/) for an explanation of property based testing.

See this [primer](https://medium.com/@thinkfunctional/a-quickcheck-primer-for-php-developers-5ffbe20c16c8) on QuickCheck for PHP developers.

See the [docs](https://eris.readthedocs.io) for Eris.

See the [source](https://github.com/giorgiosironi/eris) for Eris.

See [this](https://www.youtube.com/watch?v=gPFSZ8oKjco) or [this](https://www.youtube.com/watch?v=hXnS_Xjwk2Y) or [this](https://www.youtube.com/watch?v=zi0rHwfiX1Q) presentation by John Hughes on QuickCheck.

## Big idea
Testing is hard. Thorough testing is impossible. Proving behavior is not the same as testing behavior.

Property based testing seeks to prove that properties for a function will hold for all possible inputs. By generating tests based on properties, a property based testing tool can generate thousands of tests to verify whether the properties hold, or if they don't, it will try to narrow down the failure cases to identify exactly where the failure arose.

The developer is no longer concerned with how to express a specific test to identify correct or incorrect behavior, but rather identify what properties must hold for correct behavior.

## Examples
All the example tests from the Eris package have been copied into tests/Examples.

Run `composer install` and `phpunit tests/Examples` to run the example tests. Note, some examples are writtent to fail so as to demonstrate how property based testing can identify the failure and locate exactly where the property is failing.

A simple example is tests/Examples/ReadmeTest.php which fails on integers not less than 42. Random numbers between 0 and 1000 are chosen for candidate tests. The tests for all numbers not less than 42 will fail but running the test with `phpunit tests/Examples/ReadmeTest.php` correctly identify the failure point:

```
$ phpunit tests/Examples/ReadmeTest.php
PHPUnit 7.5.13 by Sebastian Bergmann and contributors.

F                                                                   1 / 1 (100%)
Reproduce with:
ERIS_SEED=1562436458708132 vendor/bin/phpunit --filter 'ReadmeTest::testNaturalNumbersMagnitude'


Time: 146 ms, Memory: 6.00 MB

There was 1 failure:

1) ReadmeTest::testNaturalNumbersMagnitude
42 is not less than 42 apparently
Failed asserting that false is true.
```

Note that while generated tests randomize the test environment, you can rerun a test with the exact same sequence by specifying the same `ERIS_SEED` in the environment. This is very useful when fixing a bug and you want to exactly reproduce the test environment.

## Further reading
[An introduction to QuickCheck testing](https://www.schoolofhaskell.com/user/pbv/an-introduction-to-quickcheck-testing)

[QuickCheck and Magic of Testing](https://www.fpcomplete.com/blog/2017/01/quickcheck)

## Alternatives
[PhpQuickCheck](https://github.com/steos/php-quickcheck) is the other contender in the PHP space. It is a port from clojure.test.check.

## Summary
Is property based testing easy? - no

Is property based testing a magic bullet? - maybe

Is property based testing thorough? - it can be

Is traditional based testing thorogh? - no

Is property based testing worth it? - definetly, see talks by John Huges if you need convincing

Where else is property based testing being used? Haskell, Clojure, Elm, and probably most mainstream FP languages. As of Elm 0.19, it looks like all the standard and community packages have transitioned to property based testing. See talks listed above by John Huges about property based testing in industry. Read [Experiences with QuickCheck: Testing the Hard Stuff and Staying Sane](https://www.cs.tufts.edu/~nr/cs257/archive/john-hughes/quviq-testing.pdf) by Huges about acceptance testing of AUTOSAR Basic Software for Volvo Cars (Arts, Hughes, Norell, and Svensson, 2015).
